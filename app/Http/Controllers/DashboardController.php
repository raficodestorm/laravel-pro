<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatReservation; // adjust if your model name differs
use App\Models\Booked_seat;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $user = $request->user();
    $role = $user->role;
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;
    $currentYear = now()->year;

    // Sum total passengers (booked seats) for this month
    $totalamountThisMonth = Booked_seat::whereYear('created_at', $currentYear)
      ->whereMonth('created_at', $currentMonth)
      ->sum('total');

    // ✅ Count total booked seats (passengers) for this month
    $bookedSeatsThisMonth = Booked_seat::whereYear('created_at', $currentYear)
      ->whereMonth('created_at', $currentMonth)
      ->pluck('booked_seats'); // Get only seat strings

    $totalPassengersThisMonth = 0;

    foreach ($bookedSeatsThisMonth as $seatString) {
      // Split by comma and count seats per row
      $seats = array_filter(explode(',', $seatString));
      $totalPassengersThisMonth += count($seats);
    }

    // ✅ Count total finished trips for this month
    $totalTripsThisMonth = Schedule::where('status', 'finished')
      ->whereYear('created_at', $currentYear)
      ->whereMonth('created_at', $currentMonth)
      ->count();


    // 📊 Get total booked seats grouped by month
    $monthlyBookings = DB::table('booked_seats')
      ->selectRaw('MONTH(created_at) as month, SUM(total) as total_passengers')
      ->whereYear('created_at', $currentYear)
      ->groupBy('month')
      ->pluck('total_passengers', 'month');

    // Prepare data for chart
    $months = [];
    $totals = [];

    for ($m = 1; $m <= 12; $m++) {
      $months[] = date('M', mktime(0, 0, 0, $m, 1));
      $totals[] = $monthlyBookings[$m] ?? 0;
    }


    $reservations = SeatReservation::latest()->paginate(8); // for booking history

    // Role-based dashboard view
    $view = "pages.dashboard.{$role}";
    if (!view()->exists($view)) {
      $view = "pages.dashboard.user";
    }


    $data = [
      'user' => $user,
      'totalamountThisMonth' => $totalamountThisMonth,
      'totalPassengersThisMonth' => $totalPassengersThisMonth,
      'totalTripsThisMonth' => $totalTripsThisMonth,
      'months' => $months,
      'totals' => $totals,
      'reservations' => $reservations,
    ];

    if ($role === 'user') {
      $userId = $user->id;

      // ✅ Count paid vs pending bookings
      $data['paidBookings'] = SeatReservation::where('user_id', $userId)
        ->where('status', 'paid')
        ->count();

      $data['pendingBookings'] = SeatReservation::where('user_id', $userId)
        ->where('status', 'pending')
        ->count();

      // ✅ Count trips based on schedule status
      $data['upcomingTrips'] = SeatReservation::where('user_id', $userId)
        ->where('status', 'paid')
        ->whereHas('schedule', function ($query) {
          $query->where('status', 'pending');
        })
        ->count();

      $data['runningTrips'] = SeatReservation::where('user_id', $userId)
        ->where('status', 'paid')
        ->whereHas('schedule', function ($query) {
          $query->where('status', 'running');
        })
        ->count();

      $data['completedTrips'] = SeatReservation::where('user_id', $userId)
        ->where('status', 'paid')
        ->whereHas('schedule', function ($query) {
          $query->where('status', 'finished');
        })
        ->count();
    }

    return view($view, $data);
  }
}
