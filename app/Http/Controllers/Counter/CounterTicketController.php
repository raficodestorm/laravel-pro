<?php

namespace App\Http\Controllers\Counter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounterTicketController extends Controller
{
    public function show(Request $request)
    {
        $bookingData = session('bookingData');

        if (!$bookingData) {
            return redirect()->route('home')
                ->with('error', 'No ticket information found.');
        }

        return view('pages.counter.ticket', compact('bookingData'));
    }
}
