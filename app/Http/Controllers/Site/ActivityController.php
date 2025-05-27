<?php

namespace App\Http\Controllers\Site;


namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ActivityController extends Controller
{
    public function welcome()
    {
        $activities = Activity::orderByDesc('popularity')->take(3)->get();
        $promotions = \App\Models\Promotion::where('active', true)->get();
        return view('welcome', compact('activities', 'promotions'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after:today',
            'people' => 'required|integer|min:1',
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0',
        ]);

        $date = $request->input('date');
        $people = $request->input('people');

        $query = Activity::whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date);

        if ($request->filled('price_min')) {
            $query->where('price_per_person', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price_per_person', '<=', $request->price_max);
        }

        $activities = $query->orderByDesc('popularity')->paginate(6);
        return view('site.results', compact('activities', 'date', 'people'));
    }

    public function show(Activity $activity, Request $request)
    {
        $date = $request->input('date');

        $related = $activity->related();

        if ($date) {
            $related->whereDate('start_date', '<=', $date)
                ->whereDate('end_date', '>=', $date);
        }

        $related = $related->get();

        return view('site.detail', compact('activity', 'related', 'date'));
    }
}
