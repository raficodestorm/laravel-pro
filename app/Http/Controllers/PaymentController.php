<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Step 1: Show payment page with dynamic data
    public function showPaymentPage($id)
    {
        // Fetch reservation from DB
        $bookingData = \App\Models\SeatReservation::findOrFail($id);

        return view('pages.user.payment', compact('bookingData'));
    }

    // Step 2: Process payment
    public function process(Request $request)
    {
        $method = $request->paymentMethod;

        // Basic validation
        if ($method === 'card') {
            $request->validate([
                'cardNumber' => 'required',
                'expiry' => 'required',
                'cvv' => 'required',
            ]);
        } elseif ($method === 'wallet') {
            $request->validate(['walletNumber' => 'required']);
        }

        // Simulate success (later you can integrate bKash/Nagad gateway)
        return redirect()->route('confirmation')->with('success', '✅ Payment Successful! Your ticket is confirmed.');
    }
}
