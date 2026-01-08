@extends('layouts.userlayout')

@section('content')

<style>
    /* ===============================
   PRO BUS TICKET DESIGN (PRINT FIX)
================================ */
    :root {
        --ticket-red: #d34836;
        --ticket-bg: #fff5f4;
    }

    .ticket-wrapper {
        display: flex;
        justify-content: center;
        padding: 40px 20px;
        background-color: #f0f2f5;
    }

    .ticket {
        display: flex;
        width: 950px;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        position: relative;
        /* Force Print Colors */
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    /* TOP BAR FIX: Using Inset Shadow to force color */
    .ticket-top-bar {
        background-color: var(--ticket-red) !important;
        box-shadow: inset 0 0 0 1000px var(--ticket-red) !important;
        /* The Magic Fix */
        color: #ffffff !important;
        padding: 15px 25px;
        display: flex;
        align-items: center;
        font-size: 18px;
        font-weight: 700;
    }

    .ticket-left {
        flex: 2.2;
        display: flex;
        flex-direction: column;
    }

    /* MAIN CONTENT FIX: Using Inset Shadow to force color */
    .ticket-main-content {
        padding: 30px;
        background-color: var(--ticket-bg) !important;
        box-shadow: inset 0 0 0 1000px var(--ticket-bg) !important;
        /* The Magic Fix */
        flex-grow: 1;
        display: grid;
        grid-template-columns: 1fr 1fr 0.4fr;
        gap: 20px;
        position: relative;
    }

    .ticket-right {
        flex: 1;
        border-left: 2px dashed #ccc;
        background-color: var(--ticket-bg) !important;
        box-shadow: inset 0 0 0 1000px var(--ticket-bg) !important;
        /* The Magic Fix */
        display: flex;
        flex-direction: column;
        position: relative;
    }

    /* Circular punch effect */
    .ticket-right::before,
    .ticket-right::after {
        content: "";
        position: absolute;
        left: -10px;
        width: 20px;
        height: 20px;
        background: #f0f2f5;
        border-radius: 50%;
        z-index: 10;
    }

    .ticket-right::before {
        top: -10px;
    }

    .ticket-right::after {
        bottom: -10px;
    }

    /* Data Display */
    .data-label {
        font-size: 13px;
        color: #777;
        margin-bottom: 2px;
        display: block;
    }

    .data-value {
        font-size: 16px;
        font-weight: 700;
        color: #222;
        text-transform: uppercase;
    }

    .ticket-brand {
        font-size: 22px;
        font-weight: 800;
        color: #ffffff !important;
    }


    .vertical-barcode {
        width: 50px;
        height: 150px;
        background: repeating-linear-gradient(to bottom, #333 0, #333 2px, transparent 2px, transparent 4px) !important;
        opacity: 0.8;
    }

    .stub-content {
        padding: 25px;
    }

    .stub-header {
        font-weight: 800;
        color: var(--ticket-red) !important;
        margin-bottom: 15px;
        font-size: 18px;
    }

    /* PRINT SETTINGS */
    @media print {
        @page {
            margin: 0;
            size: auto;
        }

        body {
            background: white !important;
            margin: 0 !important;
        }

        .no-print {
            display: none !important;
        }

        .ticket-wrapper {
            padding: 0 !important;
            background: none !important;
            margin-top: 50px;
        }

        .ticket {
            box-shadow: none !important;
            border: 1px solid #eee !important;
            width: 100% !important;
            border-radius: 0;
        }

        .ticket-right::before,
        .ticket-right::after {
            display: none;
        }

        /* Hide the grey circles on white paper */

        /* Ensure colors are forced */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

<div class="container mt-4">
    <div class="text-end mb-4 no-print">
        <button class="btn btn-primary px-4 shadow-sm" onclick="printTicket()">
            <i class="fas fa-print me-2"></i> Print Ticket
        </button>
        <button class="btn btn-success px-4 shadow-sm" onclick="downloadPDF()">
            <i class="fas fa-file-pdf me-2"></i> Save PDF
        </button>
    </div>

    <div id="ticket-area" class="ticket-wrapper">
        <div class="ticket">
            <div class="ticket-left">
                <div class="ticket-top-bar">
                    RunStar Transport
                </div>

                <div class="ticket-main-content">
                    <div>
                        <div class="mb-4">
                            <span class="data-label">Passenger:</span>
                            <span class="data-value">{{ $bookingData->name }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="data-label">Route:</span>
                            <span class="data-value">{{ $bookingData->route }}</span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="data-label">From:</span>
                                <span class="data-value">{{ $bookingData->boarding }}</span>
                            </div>
                            <div class="col-6">
                                <span class="data-label">To:</span>
                                <span class="data-value">{{ $bookingData->dropping }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="mb-4">
                            <span class="data-label">Seat(s):</span>
                            <span class="data-value">{{ $bookingData->selected_seats }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="data-label">Coach:</span>
                            <span class="data-value">{{ $bookingData->coach_no }}</span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span class="data-label">Date:</span>
                                <span class="data-value">{{
                                    \Carbon\Carbon::parse($bookingData->schedule?->set_date)->format('d M Y') }}</span>
                            </div>
                            <div class="col-6">
                                <span class="data-label">Time:</span>
                                <span class="data-value">{{ $bookingData->departure }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end">
                        <div class="vertical-barcode"></div>
                    </div>

                    <div class="col-12 mt-3 pt-3 border-top d-flex justify-content-between">
                        <div>
                            <span class="data-label">PNR Number:</span>
                            <span class="data-value" style="color: var(--ticket-red) !important;">{{ session('pnr') ??
                                $bookingData->ticket->pnr }}</span>
                        </div>
                        <div class="text-end">
                            <span class="data-label">Total Fare:</span>
                            <span class="data-value" style="font-size: 20px;">৳ {{ number_format($bookingData->total, 2)
                                }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ticket-right">
                <div class="ticket-top-bar justify-content-center">
                    <div class="ticket-brand" style="font-size: 18px;">BUS TICKET</div>
                </div>

                <div class="stub-content">
                    <div class="stub-header">Counter Copy</div>
                    <div class="mb-2">
                        <span class="data-label">Name:</span>
                        <span class="data-value" style="font-size: 14px;">{{ $bookingData->name }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="data-label">Route:</span>
                        <span class="data-value" style="font-size: 14px;">{{ $bookingData->route }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="data-label">Seat / Date:</span>
                        <span class="data-value" style="font-size: 14px;">{{ $bookingData->selected_seats }} / {{
                            \Carbon\Carbon::parse($bookingData->schedule?->set_date)->format('d M') }}</span>
                    </div>

                    <div class="text-center mt-4 p-2 bg-white rounded shadow-sm">
                        {!! QrCode::size(100)->margin(1)->generate($bookingData->ticket->pnr ?? 'RUNSTAR') !!}
                    </div>
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
    function printTicket() { window.print(); }

async function downloadPDF() {
    const ticket = document.getElementById('ticket-area');
    const canvas = await html2canvas(ticket, { scale: 3, useCORS: true });
    const imgData = canvas.toDataURL('image/png');
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('l', 'mm', 'a4');
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
    pdf.addImage(imgData, 'PNG', 0, 10, pdfWidth, pdfHeight);
    pdf.save('Ticket-{{ session("pnr") ?? "Booking" }}.pdf');
}
</script>
@endpush
@endsection