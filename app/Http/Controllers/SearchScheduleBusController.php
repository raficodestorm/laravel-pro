<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class SearchScheduleBusController extends Controller
{
    // Show search form
    public function index()
    {
        return view('pages.frontend.find-bus');
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
            ->get();

        return view('pages.frontend.search-results', compact('schedules', 'from', 'to', 'date'));
    }
}
