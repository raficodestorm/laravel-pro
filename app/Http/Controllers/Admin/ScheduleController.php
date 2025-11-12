<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Booked_seat;
use App\Models\SeatReservation;
use App\Models\Route;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Supervisor;
use App\Models\Bustype;
use Illuminate\Http\Request;
use PDF;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('status', 'pending')->latest()->paginate(10);
        return view('pages.admin.schedule.index', compact('schedules'));
    }

    public function pendingtrip()
    {
        $schedules = Schedule::where('status', 'pending')->latest()->paginate(10);
        return view('pages.admin.trip.pendingtrips', compact('schedules'));
    }

    public function runningtrip()
    {
        $schedules = Schedule::where('status', 'running')->latest()->paginate(10);
        return view('pages.admin.trip.runningtrips', compact('schedules'));
    }
    public function finishedtrip()
    {
        $schedules = Schedule::where('status', 'finished')->latest()->paginate(10);
        return view('pages.admin.trip.finishedtrips', compact('schedules'));
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

    public function manage($id)
    {
        $schedule = Schedule::with(['driver', 'supervisor'])->findOrFail($id);
        $drivers = Driver::orderBy('name')->get();
        $supervisors = Supervisor::orderBy('name')->get();

        return view('pages.admin.trip.manage', compact('schedule', 'drivers', 'supervisors'));
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
            'driver_id' => 'nullable|integer',
            'supervisor_id' => 'nullable|integer',
        ]);

        $schedule->update($validated);
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully!');
    }

    public function destroytrip(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.finishedtrip')->with('success', 'Trip deleted successfully!');
    }

    public function start(Schedule $schedule)
    {
        $schedule->update(['status' => 'running']);
        return redirect()->route('admin.schedules.report', $schedule->id)
            ->with('success', 'Trip started successfully! Trip report generated below.');
    }

    public function finish(Schedule $schedule)
    {
        $schedule->update(['status' => 'finished']);
        return back()->with('success', 'Trip finished successfully!');
    }

    public function pending(Schedule $schedule)
    {
        $schedule->update(['status' => 'pending']);
        return back()->with('success', 'Trip pending successfully!');
    }


    public function tripReport(Schedule $schedule)
    {
        $bookedSeats = Booked_seat::where('schedule_id', $schedule->id)->get();

        // Calculate total passengers by summing all booked seat counts
        $totalPassengers = $bookedSeats->reduce(function ($carry, $item) {
            $seats = explode(',', $item->booked_seats);
            return $carry + count(array_filter($seats)); // filters out empty values
        }, 0);
        $seatReservations = SeatReservation::where('schedule_id', $schedule->id)->get();

        $pdf = PDF::loadView('pages.controller.trip.trip-report', [
            'schedule' => $schedule,
            'bookedSeats' => $bookedSeats,
            'seatReservations' => $seatReservations,
            'totalPassengers' => $totalPassengers
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('Trip_Report_' . $schedule->id . '.pdf');
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

    public function updateDriver(Request $request, $id)
    {
        $request->validate([
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->driver_id = $request->driver_id;
        $schedule->save();

        return redirect()->back();
    }
    public function updateSupervisor(Request $request, $id)
    {
        $request->validate([
            'supervisor_id' => 'nullable|exists:supervisors,id',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->supervisor_id = $request->supervisor_id;
        $schedule->save();

        return redirect()->back();
    }
}
