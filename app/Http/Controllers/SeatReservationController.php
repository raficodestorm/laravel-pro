<?php

namespace App\Http\Controllers;

use App\Models\SeatReservation;
use Illuminate\Http\Request;
use App\Models\Schedule;

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
        $schedule = Schedule::findOrFail($id);

        return view('pages.user.seat-reservation', compact('schedule'));
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
}
