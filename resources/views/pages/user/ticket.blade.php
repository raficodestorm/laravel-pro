@extends('layouts.userlayout')

@section('content')
<div class="container my-5">
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <div class="text-end mb-3">
    <button class="btn btn-primary me-2" onclick="printTicket()">🖨️ Print Ticket</button>
    <button class="btn btn-success" onclick="downloadPDF()">⬇️ Download PDF</button>
  </div>

  <div id="ticket-area" class="card shadow-lg p-4 rounded-4 bg-white">
    {{-- Header --}}
    <div class="ticket-header text-center mb-4">
      <img src="{{ asset('assests/image/bus-logo.png') }}" alt="Company Logo" style="height: 4.5rem;">
      <h3 class="mt-2">RunStar Transport</h3>
      <p class="text-muted">Your e-ticket has been successfully issued</p>
    </div>

    {{-- Journey Information --}}
    <div class="mb-4">
      <h5 class="fw-bold text-danger mb-3">🚌 Journey Information</h5>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td><strong>Issue Date & Time</strong></td>
            <td>{{ now()->format('d M Y, h:i A') }}</td>
          </tr>
          <tr>
            <td><strong>Journey Date</strong></td>
            <td>{{ $bookingData->departure ?? now()->format('d M Y') }}</td>
          </tr>
          <tr>
            <td><strong>From Station</strong></td>
            <td>{{ $bookingData->boarding }}</td>
          </tr>
          <tr>
            <td><strong>To Station</strong></td>
            <td>{{ $bookingData->dropping }}</td>
          </tr>
          <tr>
            <td><strong>Bus Type</strong></td>
            <td>{{ $bookingData->bus_type }}</td>
          </tr>
          <tr>
            <td><strong>Coach No</strong></td>
            <td>{{ $bookingData->coach_no }}</td>
          </tr>
          <tr>
            <td><strong>Route</strong></td>
            <td>{{ $bookingData->route }}</td>
          </tr>
          <tr>
            <td><strong>Seats</strong></td>
            <td>{{ $bookingData->selected_seats }}</td>
          </tr>
          <tr>
            <td><strong>Total Fare</strong></td>
            <td>৳ {{ number_format($bookingData->total, 2) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    {{-- Passenger Information --}}
    <div class="mb-4">
      <h5 class="fw-bold text-danger mb-3">👤 Passenger Information</h5>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td><strong>Name</strong></td>
            <td>{{ $bookingData->name }}</td>
          </tr>
          <tr>
            <td><strong>Mobile</strong></td>
            <td>{{ $bookingData->mobile }}</td>
          </tr>
          <tr>
            <td><strong>PNR Number</strong></td>
            <td>{{ strtoupper(Str::random(10)) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    {{-- QR Code and Note --}}
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <p class="text-muted small mb-0">
          Please carry this ticket along with a valid photo ID.<br>
          No need to print if showing on mobile device.
        </p>
      </div>
      <div>
        {!! QrCode::size(80)->generate('PNR-' . now()->timestamp) !!}
      </div>
    </div>

    {{-- Footer --}}
    <div class="text-center mt-3">
      <p>✅ Wishing you a safe and pleasant journey!</p>
      <h6 class="text-primary">RunStar Transport</h6>
    </div>
  </div>
</div>

{{-- Print & PDF Scripts --}}
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
</script>
@endpush
@endsection