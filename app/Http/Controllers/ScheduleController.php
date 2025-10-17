<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Route;
use App\Models\Bus;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::latest()->paginate(10);
        return view('pages.admin.schedule.index', compact('schedules'));
    }

    public function create()
    {
        return view('pages.admin.schedule.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'set_date' => 'required|date',
            'set_time' => 'required',
            'route_code' => 'required|string|max:100',
            'start_location' => 'required|string|max:100',
            'end_location' => 'required|string|max:100',
            'distance' => 'nullable|string|max:50',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'bus_type' => 'required|string|max:100',
            'coach_no' => 'required|string|max:50',
        ]);

        Schedule::create($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule added successfully!');
    }

    public function show(Schedule $schedule)
    {
        return view('pages.admin.schedule.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('pages.admin.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'set_date' => 'required|date',
            'set_time' => 'required',
            'route_code' => 'required|string|max:100',
            'start_location' => 'required|string|max:100',
            'end_location' => 'required|string|max:100',
            'distance' => 'nullable|string|max:50',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'bus_type' => 'required|string|max:100',
            'coach_no' => 'required|string|max:50',
        ]);

        $schedule->update($validated);
        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully!');
    }

    // AJAX: Get Route Info
    public function getRouteInfo(Request $request)
    {
        $route = Route::where('route_code', $request->route_code)->first();
        return response()->json($route);
    }

    // AJAX: Get Coach Numbers by Bus Type
    public function getCoachesByBusType(Request $request)
    {
        $buses = Bus::where('bus_type', 'LIKE', '%' . $request->bus_type . '%')->pluck('coach_no');
        return response()->json($buses);
    }
}
