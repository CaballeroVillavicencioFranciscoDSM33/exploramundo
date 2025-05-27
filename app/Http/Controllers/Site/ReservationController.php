<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('swal_error', 'Debes iniciar sesión para hacer una reserva.');
        }

        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'people' => 'required|integer|min:1',
            'execution_date' => [
                'required',
                'date',
                'after:today',
                function ($attribute, $value, $fail) use ($request) {
                    $activity = Activity::find($request->activity_id);
                    if ($activity && ($value < $activity->start_date || $value > $activity->end_date)) {
                        $fail('La fecha seleccionada está fuera del rango permitido para esta actividad.');
                    }
                },
            ],
        ]);

        $activity = Activity::findOrFail($validated['activity_id']);
        $totalPrice = $activity->price_per_person * $validated['people'];

        Reservation::create([
            'activity_id' => $activity->id,
            'user_id' => Auth::id(),
            'people' => $validated['people'],
            'total_price' => $totalPrice,
            'reservation_date' => now(),
            'execution_date' => $validated['execution_date'],
        ]);

        $activity->increment('popularity');

        return redirect()->route('reservations.index')->with('success', '¡Reserva realizada correctamente!');
    }

    public function index()
    {
        $reservations = Auth::user()->reservations()->with('activity')->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);
        return view('reservations.show', compact('reservation'));
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Reserva cancelada correctamente.');
    }

    private function authorizeReservation(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
