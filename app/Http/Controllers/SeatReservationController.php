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
    public function store(Request $request) {}

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

    public function payment(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'Bus_type' => 'required|string',
            'coach_no' => 'required|string',
            'route' => 'required|string',
            'seat_price' => 'required|string',
            'selectedSeats' => 'required|string',
            'total' => 'required|string',
            'boarding' => 'required|string',
            'dropping' => 'required|string',
            'name' => 'required|string|max:100',
            'mobile' => 'required|string|max:20',
        ]);

        // Remove currency symbol and spaces
        $seatPrice = floatval(preg_replace('/[^0-9.]/', '', $validated['seat_price']));
        $totalAmount = floatval(preg_replace('/[^0-9.]/', '', $validated['total']));

        SeatReservation::create([
            'schedule_id' => $validated['schedule_id'],
            'bus_type' => $validated['Bus_type'],
            'coach_no' => $validated['coach_no'],
            'route' => $validated['route'],
            'seat_price' => $seatPrice,
            'selected_seats' => $validated['selectedSeats'],
            'total' => $totalAmount,
            'boarding' => $validated['boarding'],
            'dropping' => $validated['dropping'],
            'name' => $validated['name'],
            'mobile' => $validated['mobile'],
        ]);

        redirect()->back()->with('success', 'Seat reservation completed successfully!');
    }
}
