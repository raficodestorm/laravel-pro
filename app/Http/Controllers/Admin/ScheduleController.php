<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Route;
use App\Models\Bus;
use App\Models\Bustype;
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
        $bustypes = Bustype::orderBy('type', 'asc')->get();
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.schedule.create', compact('routes', 'bustypes'));
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
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule added successfully!');
    }

    public function show(Schedule $schedule)
    {
        return view('pages.admin.schedule.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $bustypes = Bustype::orderBy('type', 'asc')->get();
        $routes = Route::orderBy('route_code', 'asc')->get();
        return view('pages.admin.schedule.edit', compact('schedule', 'routes', 'bustypes'));
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
            'status' => ['required', 'in:pending,running,finished'],
        ]);

        $schedule->update($validated);
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully!');
    }

    public function start(Schedule $schedule)
    {
    $schedule->update(['status' => 'running']);
    return redirect()->route('admin.schedules.show', $schedule)->with('success', 'Trip started successfully!');
    }

    public function finish(Schedule $schedule)
    {
    $schedule->update(['status' => 'finished']);
    return redirect()->route('admin.schedules.show', $schedule)->with('success', 'Trip finished successfully!');
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
