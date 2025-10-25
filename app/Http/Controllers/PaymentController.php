<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatReservation;

class PaymentController extends Controller
{
    /**
     * Step 1: Show payment page with dynamic booking data
     */
    public function showPaymentPage($id)
    {
        // Fetch reservation from DB
        $bookingData = SeatReservation::findOrFail($id);

        return view('pages.user.payment', compact('bookingData'));
    }

    /**
     * Step 2: Process payment form submission
     */
    public function processPayment(Request $request)
    {
        // Validate payment method
        $method = $request->paymentMethod;

        if ($method === 'card') {
            $request->validate([
                'cardNumber' => 'required',
                'expiry' => 'required',
                'cvv' => 'required',
            ]);
        } elseif ($method === 'wallet') {
            $request->validate([
                'walletNumber' => 'required',
            ]);
        } elseif (empty($method)) {
            return back()->withErrors(['paymentMethod' => 'Please select a payment method.']);
        }

        // Decode booking data (sent as hidden input JSON)
        $bookingData = json_decode($request->bookingData);

        // (Optional) Save payment status in DB here
        // Example:
        // SeatReservation::where('id', $bookingData->id)->update(['status' => 'paid']);

        // Redirect to ticket page with success message
        return redirect()->route('user.ticket')
            ->with('success', '✅ Payment Successful! Your ticket is confirmed.')
            ->with('bookingData', $bookingData);
    }
}
