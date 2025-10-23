<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Step 1: Show payment page with dynamic data
    public function showPaymentPage(Request $request)
    {
        // Receive booking data from reservation form
        $bookingData = $request->all();

        // Ensure at least seats are selected
        if (empty($bookingData['selectedSeats'])) {
            return redirect()->back()->with('error', 'Please select at least one seat.');
        }

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
