<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Location;

class SearchScheduleBusController extends Controller
{
    // Show search form
    public function index()
    {
        $location = Location::orderBy('district')->get();
        return view('pages.user.userfront', compact('location'));
    }

    // Handle search request
    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $from = $request->from;
        $to = $request->to;
        $date = $request->date;

        // Find matching schedules
        $schedules = Schedule::whereDate('set_date', $date)
            ->where('start_location', 'LIKE', "%$from%")
            ->where('end_location', 'LIKE', "%$to%")
            ->where('status', 'LIKE', "pending")
            ->get();

        return view('pages.user.search-schedule-result', compact('schedules', 'from', 'to', 'date'));
    }

    public function getLocations(Request $request)
    {
        $search = $request->get('q'); // 'q' মানে query string থেকে পাঠানো টেক্সট
        $locations = Location::where('district', 'LIKE', "%{$search}%")
            ->pluck('district');

        return response()->json($locations);
    }
}
