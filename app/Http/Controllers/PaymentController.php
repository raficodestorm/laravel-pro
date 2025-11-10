<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SeatReservation;
use Illuminate\Support\Facades\DB;


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

        // ✅ Decode booking data from hidden field
        $bookingData = json_decode($request->bookingData);

        // ✅ Find reservation again from DB (always safest)
        $reservation = SeatReservation::findOrFail($bookingData->id);

        // ✅ 1) Update reservation status to PAID
        $reservation->update([
            'status' => 'paid',
        ]);

        // ✅ 2) Store booked seats in booked_seats table
        DB::table('booked_seats')->insert([
            'user_id'      => $reservation->user_id,
            'schedule_id'  => $reservation->schedule_id,
            'coach_no'     => $reservation->coach_no,
            'booked_seats' => $reservation->selected_seats,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // ✅ 3) Redirect to ticket page with session data
        return redirect()
            ->route('user.ticket')
            ->with('success', '✅ Payment Successful! Your ticket is confirmed.')
            ->with('bookingData', $reservation);
    }
}
