<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SeatReservation;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Counter;

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
            'selected_seats' => 'required|string',
            'total' => 'required|string',
            'boarding' => 'required|string',
            'dropping' => 'required|string',
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

    public function see($id)
    {
        // $schedule = Schedule::findOrFail($id);

        // return view('pages.user.seat-reservation', compact('schedule'));
        $schedule = Schedule::findOrFail($id);

        // start_location এর counters
        $boardingCounters = Counter::where('location_id', $schedule->start_location)->get();

        // end_location এর counters
        $droppingCounters = Counter::where('location_id', $schedule->end_location)->get();

        return view('pages.user.seat-reservation', [
            'schedule' => $schedule,
            'boardingCounters' => $boardingCounters,
            'droppingCounters' => $droppingCounters,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeatReservation $seatReservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SeatReservation $seatReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeatReservation $seatReservation)
    {
        //
    }

    public function payment(Request $request) {}
    public function showReservationPage($schedule_id) {}
}
