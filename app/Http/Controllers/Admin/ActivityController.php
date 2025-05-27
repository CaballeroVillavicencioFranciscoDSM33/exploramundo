<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::all();
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:64',
            'description' => 'required|string',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'price_per_person' => 'required|numeric|min:0',
            'popularity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'related' => 'nullable|array',
            'related.*' => 'exists:activities,id'
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('activities', 'public');
        }

        $activity = Activity::create($validated);

        if (!empty($validated['related'])) {
            $activity->related()->sync($validated['related']);
        }

        return redirect()->route('admin.activities.index')->with('success', 'Actividad creada.');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:64',
            'description' => 'required|string',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'price_per_person' => 'required|numeric|min:0',
            'popularity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'related' => 'nullable|array',
            'related.*' => 'exists:activities,id'
        ]);

        if ($request->hasFile('image')) {
            if ($activity->image_path) {
                Storage::disk('public')->delete($activity->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('activities', 'public');
        }

        $activity->update($validated);

        if (!empty($validated['related'])) {
            $activity->related()->sync($validated['related']);
        } else {
            $activity->related()->detach();
        }

        return redirect()->route('admin.activities.index')->with('success', 'Actividad actualizada.');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image_path) {
            Storage::disk('public')->delete($activity->image_path);
        }

        $activity->related()->detach();
        $activity->delete();

        return redirect()->route('admin.activities.index')->with('success', 'Actividad eliminada.');
    }
}
