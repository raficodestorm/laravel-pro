<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show(Request $request)
    {
        $bookingData = session('bookingData');

        if (!$bookingData) {
            return redirect()->route('home')
                ->with('error', 'No ticket information found.');
        }

        return view('pages.user.ticket', compact('bookingData'));
    }
}
