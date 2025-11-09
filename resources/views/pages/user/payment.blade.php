@extends('layouts.userlayout')

@section('content')
<div class="container payment-page my-5">
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="row">
    {{-- LEFT SIDE - Booking Summary --}}
    <div class="col-md-5">
      <div class="card shadow-lg p-4 rounded-4 mb-4">
        <h4 class="mb-3">🚌 Booking Summary</h4>
        <p>
          <strong>Passenger:</strong> {{ $bookingData->name }} <br>
          <strong>Mobile:</strong> {{ $bookingData->mobile }} <br>
          <strong>Boarding:</strong> {{ $bookingData->boarding }} <br>
          <strong>Dropping:</strong> {{ $bookingData->dropping }} <br>
        </p>

        <p>
          <strong>Bus Type:</strong> {{ $bookingData->bus_type }} <br>
          <strong>Coach No:</strong> {{ $bookingData->coach_no }} <br>
          <strong>Route:</strong> {{ $bookingData->route }} <br>
          <strong>Departure:</strong> {{ $bookingData->departure }}
        </p>

        <p>
          <strong>Seats:</strong>
          @if(!empty($bookingData->selected_seats))
          {{ $bookingData->selected_seats }}
          @else
          No seats selected
          @endif
        </p>

        @php
        // Extract total amount (remove currency symbol if present)
        $totalAmount = preg_replace('/[^\d.]/', '', $bookingData['total'] ?? 0);
        @endphp

        <div class="fare-summary mt-3">
          <h5>Total Fare:</h5>
          <h3 class="text-success">৳ {{ number_format($bookingData->total, 2) }}</h3>
        </div>
      </div>
    </div>

    {{-- RIGHT SIDE - Payment Options --}}
    <div class="col-md-7">
      <div class="card shadow-lg p-4 rounded-4">
        <h4 class="mb-3">💳 Payment Details</h4>

        <form method="POST" action="{{ route('payment.process') }}">
          @csrf
          <input type="hidden" name="bookingData" value='@json($bookingData)'>

          {{-- Payment Method --}}
          <div class="mb-3">
            <label class="form-label">Select Payment Method:</label>
            <select class="form-select" id="paymentMethod" name="paymentMethod" required
              onchange="togglePaymentFields(this.value)">
              <option value="">-- Choose Method --</option>
              <option value="card">Credit/Debit Card</option>
              <option value="wallet">Mobile Wallet (bKash, Nagad, Rocket)</option>
              <option value="netbanking">Net Banking</option>
              <option value="cod">Cash at Counter</option>
            </select>
          </div>

          {{-- Card Payment --}}
          <div id="cardFields" style="display: none;">
            <div class="mb-3">
              <label class="form-label">Card Number</label>
              <input type="text" name="cardNumber" class="form-control" placeholder="1234 5678 9012 3456">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Expiry Date</label>
                <input type="text" name="expiry" class="form-control" placeholder="MM/YY">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">CVV</label>
                <input type="password" name="cvv" class="form-control" placeholder="123">
              </div>
            </div>
          </div>

          {{-- Wallet --}}
          <div id="walletFields" style="display: none;">
            <div class="mb-3">
              <label class="form-label">Wallet Number</label>
              <input type="text" name="walletNumber" class="form-control" placeholder="01XXXXXXXXX">
            </div>
          </div>

          {{-- Cash on Counter --}}
          <div id="codNotice" style="display: none;">
            <div class="alert alert-info">
              You have chosen <strong>Cash at Counter</strong>. Please pay at the bus counter before departure.
            </div>
          </div>

          {{-- Confirm Button --}}
          <button type="submit" class="btn btn-success w-100 rounded-3 py-2 mt-3">
            Confirm & Pay ৳{{ number_format($totalAmount, 2) }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Inline Script --}}
<script>
  function togglePaymentFields(method) {
    document.getElementById('cardFields').style.display = (method === 'card') ? 'block' : 'none';
    document.getElementById('walletFields').style.display = (method === 'wallet') ? 'block' : 'none';
    document.getElementById('codNotice').style.display = (method === 'cod') ? 'block' : 'none';
}
</script>
@endsection