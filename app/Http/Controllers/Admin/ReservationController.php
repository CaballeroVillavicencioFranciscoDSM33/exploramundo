<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'activity'])->latest()->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $users = User::all();
        $activities = Activity::all();
        return view('admin.reservations.create', compact('users', 'activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_id' => 'required|exists:activities,id',
            'execution_date' => 'required|date|after:today',
            'people' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        Reservation::create([
            'user_id' => $request->user_id,
            'activity_id' => $request->activity_id,
            'execution_date' => $request->execution_date,
            'reservation_date' => now(),
            'people' => $request->people,
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit(Reservation $reservation)
    {
        $users = User::all();
        $activities = Activity::all();
        return view('admin.reservations.edit', compact('reservation', 'users', 'activities'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_id' => 'required|exists:activities,id',
            'execution_date' => 'required|date|after:today',
            'people' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        $reservation->update([
            'user_id' => $request->user_id,
            'activity_id' => $request->activity_id,
            'execution_date' => $request->execution_date,
            'people' => $request->people,
            'total_price' => $request->total_price,
        ]);

        return redirect()->route('admin.reservations.index')->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
