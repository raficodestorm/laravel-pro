@extends('layouts.userlayout')

@section('content')

<style>
/* ===============================
   TICKET DESIGN (TRAIN STYLE)
================================ */
.ticket-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.ticket {
    display: flex;
    background: #fff;
    width: 900px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(0,0,0,.15);
    font-family: 'Segoe UI', sans-serif;
}

/* LEFT MAIN TICKET */
.ticket-left {
    flex: 3;
    padding: 20px 25px;
    position: relative;
}

/* RIGHT STUB */
.ticket-right {
    flex: 1.2;
    border-left: 2px dashed #ddd;
    padding: 20px;
    text-align: left;
}

/* HEADER */
.ticket-header {
    background: #c4161c;
    color: #fff;
    padding: 12px 20px;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 1px;
}

.ticket-header span {
    font-size: 14px;
    font-weight: 400;
    margin-left: 10px;
}

/* ROWS */
.ticket-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 14px;
}

.ticket-row strong {
    color: #333;
}

/* SECTIONS */
.ticket-section {
    margin-top: 15px;
}

.ticket-section-title {
    font-weight: 700;
    font-size: 13px;
    margin-bottom: 6px;
    color: #666;
    text-transform: uppercase;
}

/* BARCODE */
.barcode {
    position: absolute;
    right: 10px;
    top: 60px;
    width: 45px;
    height: 180px;
    background: repeating-linear-gradient(
        to bottom,
        #000,
        #000 2px,
        #fff 2px,
        #fff 4px
    );
}

/* RIGHT SIDE */
.stub-title {
    font-weight: 700;
    color: #c4161c;
    margin-bottom: 10px;
}

.stub-row {
    font-size: 13px;
    margin-bottom: 8px;
}

/* BUTTONS */
.btn-print, .btn-download {
    border-radius: 6px;
    padding: 8px 14px;
    font-size: 14px;
}

/* PRINT */
@media print {
    body * {
        visibility: hidden;
    }
    #ticket-area, #ticket-area * {
        visibility: visible;
    }
    #ticket-area {
        position: absolute;
        left: 0;
        top: 0;
    }
}
</style>

<div class="container">

    <div class="text-end mb-3">
        <button class="btn btn-primary btn-print me-2" onclick="printTicket()">🖨️ Print</button>
        <button class="btn btn-success btn-download" onclick="downloadPDF()">⬇️ PDF</button>
    </div>

    <div id="ticket-area" class="ticket-wrapper">

        <div class="ticket">

            {{-- LEFT --}}
            <div class="ticket-left">

                <div class="ticket-header">
                    🚌 BUS TICKET <span>RunStar Transport</span>
                </div>

                <div class="barcode"></div>

                <div class="ticket-section">
                    <div class="ticket-row">
                        <span><strong>Passenger:</strong> {{ $bookingData->name }}</span>
                        <span><strong>Seat:</strong> {{ $bookingData->selected_seats }}</span>
                    </div>

                    <div class="ticket-row">
                        <span><strong>Route:</strong> {{ $bookingData->route }}</span>
                        <span><strong>Coach:</strong> {{ $bookingData->coach_no }}</span>
                    </div>
                </div>

                <div class="ticket-section">
                    <div class="ticket-row">
                        <span><strong>From:</strong> {{ $bookingData->boarding }}</span>
                        <span><strong>To:</strong> {{ $bookingData->dropping }}</span>
                    </div>

                    <div class="ticket-row">
                        <span><strong>Date:</strong>
                            {{ \Carbon\Carbon::parse($bookingData->schedule?->set_date)->format('d M Y') }}
                        </span>
                        <span><strong>Time:</strong> {{ $bookingData->departure }}</span>
                    </div>
                </div>

                <div class="ticket-section">
                    <div class="ticket-row">
                        <span><strong>Fare:</strong> ৳ {{ number_format($bookingData->total, 2) }}</span>
                        <span><strong>PNR:</strong> {{ session('pnr') ?? $bookingData->ticket->pnr }}</span>
                    </div>
                </div>

            </div>

            {{-- RIGHT STUB --}}
            <div class="ticket-right">

                <div class="stub-title">BUS TICKET</div>

                <div class="stub-row"><strong>Name:</strong> {{ $bookingData->name }}</div>
                <div class="stub-row"><strong>Route:</strong> {{ $bookingData->route }}</div>
                <div class="stub-row"><strong>Seat:</strong> {{ $bookingData->selected_seats }}</div>
                <div class="stub-row"><strong>Date:</strong>
                    {{ \Carbon\Carbon::parse($bookingData->schedule?->set_date)->format('d M Y') }}
                </div>

                <div class="mt-3 text-center">
                    {!! QrCode::size(80)->generate($bookingData->ticket->pnr ?? 'RUNSTAR') !!}
                </div>

            </div>

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

    const pdf = new jsPDF('l', 'mm', 'a4');
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

    pdf.addImage(imgData, 'PNG', 10, 10, pdfWidth - 20, pdfHeight);
    pdf.save('RunStar-Bus-Ticket.pdf');
}
</script>
@endpush

@endsection
