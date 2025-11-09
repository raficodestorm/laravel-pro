<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SeatReservation;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Counter;
use App\Models\Location;

class SeatReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'bus_type' => 'required|string',
            'coach_no' => 'required|string',
            'route' => 'required|string',
            'seat_price' => 'required|string',
            'departure' => 'required|string',
            'boarding' => 'required|string',
            'dropping' => 'required|string',
            'selected_seats' => 'required|string',
            'total' => 'required|string',
            'name' => 'required|string|max:100',
            'mobile' => 'required|string|max:20',
        ]);

        $validated['seat_price'] = str_replace(',', '', $validated['seat_price']);
        $validated['total'] = str_replace(',', '', $validated['total']);

        $reservation = SeatReservation::create($validated);
        return redirect()->route('payment.for', ['id' => $reservation->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SeatReservation $seatReservation)
    {
        //
    }
    // $schedule = Schedule::findOrFail($id);

    // return view('pages.user.seat-reservation', compact('schedule'));
    public function see($id)
    {
        $schedule = Schedule::with('bus')->findOrFail($id);

        $seatLayout = $schedule->bus->seat_layout;
        $seatCapacity = $schedule->bus->seat_capacity;
        $bustype = $schedule->bus->bus_type;

        // ✅ boarding counters filtering by district name
        $boardingCounters = Counter::whereHas('locationinfo', function ($q) use ($schedule) {
            $q->where('district', $schedule->start_location);
        })->get();

        // ✅ dropping counters filtering by district name
        $droppingCounters = Counter::whereHas('locationinfo', function ($q) use ($schedule) {
            $q->where('district', $schedule->end_location);
        })->get();

        return view('pages.user.seat-reservation', compact(
            'schedule',
            'seatLayout',
            'seatCapacity',
            'bustype',
            'boardingCounters',
            'droppingCounters',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservation = SeatReservation::findOrFail($id);

        return view('pages.user.edit-reservation', compact('reservation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reservation = SeatReservation::findOrFail($id);

        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'bus_type' => 'required|string',
            'coach_no' => 'required|string',
            'route' => 'required|string',
            'seat_price' => 'required|string',
            'departure' => 'required|string',
            'boarding' => 'required|string',
            'dropping' => 'required|string',
            'selected_seats' => 'required|string',
            'total' => 'required|string',
            'name' => 'required|string|max:100',
            'mobile' => 'required|string|max:20',
        ]);

        $reservation->update([
            'schedule_id' => 'required|exists:schedules,id',
            'bus_type' => 'required|string',
            'coach_no' => 'required|string',
            'route' => 'required|string',
            'seat_price' => 'required|string',
            'departure' => 'required|string',
            'boarding' => 'required|string',
            'dropping' => 'required|string',
            'selected_seats' => 'required|string',
            'total' => 'required|string',
            'name' => 'required|string|max:100',
            'mobile' => 'required|string|max:20',
        ]);

        return redirect()->back()->with('success', 'Reservation updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeatReservation $seatReservation)
    {
        //
    }
}
