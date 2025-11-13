@extends('layouts.userlayout')

@section('content')

<div class="container my-5">

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="text-end mb-3">
    <button class="btn btn-primary btn-print me-2" onclick="printTicket()">🖨️ Print Ticket</button>
    <button class="btn btn-success btn-download" onclick="downloadPDF()">⬇️ Download PDF</button>
  </div>

  <div id="ticket-area" class="ticket-container">

    {{-- Header --}}
    <div class="ticket-header">
      {{-- <img src="{{ asset('assests/image/bus-logo.png') }}" alt="Logo"> --}}
      <h2 class="ticket-title">RunStar Transport</h2>
      <p class="ticket-subtitle">Your e-ticket has been successfully issued</p>
    </div>

    {{-- Journey Info --}}
    <div class="mb-3">
      <h5 class="section-title">🚌 Journey Information</h5>
      <table class="custom-table">
        <tr>
          <td>Issue Date & Time</td>
          <td id="issue-time"></td>
        </tr>
        <tr>
          <td>Journey Date</td>
          <td>
            {{ $bookingData->schedule?->set_date ?
            \Carbon\Carbon::parse($bookingData->schedule->set_date)->format('d/m/y') : '' }}
          </td>

        </tr>
        <tr>
          <td>Departure time</td>
          <td>{{ $bookingData->departure ?? now()->format('d M Y') }}</td>
        </tr>
        <tr>
          <td>From Station</td>
          <td>{{ $bookingData->boarding }}</td>
        </tr>
        <tr>
          <td>To Station</td>
          <td>{{ $bookingData->dropping }}</td>
        </tr>
        <tr>
          <td>Bus Type</td>
          <td>{{ $bookingData->bus_type }}</td>
        </tr>
        <tr>
          <td>Coach No</td>
          <td>{{ $bookingData->coach_no }}</td>
        </tr>
        <tr>
          <td>Route</td>
          <td>{{ $bookingData->route }}</td>
        </tr>
        <tr>
          <td>Seats</td>
          <td>{{ $bookingData->selected_seats }}</td>
        </tr>
        <tr>
          <td>Total Fare</td>
          <td>৳ {{ number_format($bookingData->total, 2) }}</td>
        </tr>
      </table>
    </div>

    {{-- Passenger Info --}}
    <div class="mb-3">
      <h5 class="section-title">👤 Passenger Information</h5>
      <table class="custom-table">
        <tr>
          <td>Name</td>
          <td>{{ $bookingData->name }}</td>
        </tr>
        <tr>
          <td>Mobile</td>
          <td>{{ $bookingData->mobile }}</td>
        </tr>
        <tr>
          <td>PNR Number</td>
          <td>{{ session('pnr') ?? $bookingData->ticket->pnr ?? 'N/A' }}</td>
        </tr>
      </table>
    </div>

    {{-- QR + Note --}}
    <div class="d-flex justify-content-between align-items-start mt-3">
      <p class="note-text">
        Please carry this ticket along with a valid photo ID.<br>
        No need to print if showing on mobile.
      </p>
      <div class="qr-box">
        {!! QrCode::size(90)->generate('PNR-' . now()->timestamp) !!}
      </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-4">
      <p class="fw-semibold text-success mb-1">✅ Wishing you a safe and pleasant journey!</p>
      <h6 class="text-primary">RunStar Transport</h6>
    </div>

  </div>
</div>

{{-- Scripts --}}
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
  function printTicket() {
    window.print();
}

async function downloadPDF() {
    const ticket = document.getElementById('ticket-area');
    const canvas = await html2canvas(ticket, { scale: 2 });
    const imgData = canvas.toDataURL('image/png');
    const { jsPDF } = window.jspdf;

    const pdf = new jsPDF('p', 'mm', 'a4');
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    pdf.save('BusTicket.pdf');
}


  document.addEventListener("DOMContentLoaded", function() {
    const issueTimeElement = document.getElementById('issue-time');
    const now = new Date();

    // Format as: "12 Nov 2025, 10:45 PM"
    const options = {
      day: '2-digit',
      month: 'short',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit',
      hour12: true,
    };

    issueTimeElement.textContent = now.toLocaleString(undefined, options);
  });

</script>
@endpush
@endsection