<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SeatReservation; // or SeatReservation / Booking — use your actual model

class UserBookingController extends Controller
{
    public function index()
    {
        // Fetch all bookings of the logged-in user
        $bookings = SeatReservation::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.user.bookings.index', compact('bookings'));
    }



    public function active(Request $request)
    {
        $reservations = SeatReservation::with(['schedule', 'route'])
            ->where('user_id', $request->user()->id)
            ->where('status', 'paid')
            ->latest()
            ->paginate(10);

        return view('pages.user.bookings.active', compact('reservations'));
    }

    public function pending(Request $request)
    {
        $reservations = SeatReservation::with(['schedule', 'route'])
            ->where('user_id', $request->user()->id)
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('pages.user.bookings.pending', compact('reservations'));
    }

    public function upcoming(Request $request)
    {
        $reservations = SeatReservation::with(['schedule', 'route'])
            ->where('user_id', $request->user()->id)
            ->where('status', 'paid')
            ->whereHas('schedule', fn($q) => $q->where('status', 'pending'))
            ->latest()
            ->paginate(10);

        return view('pages.user.trips.upcoming', compact('reservations'));
    }

    public function completed(Request $request)
    {
        $reservations = SeatReservation::with(['schedule', 'route'])
            ->where('user_id', $request->user()->id)
            ->where('status', 'paid')
            ->whereHas('schedule', fn($q) => $q->where('status', 'finished'))
            ->latest()
            ->paginate(10);

        return view('pages.user.trips.completed', compact('reservations'));
    }
}
