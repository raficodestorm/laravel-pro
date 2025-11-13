<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Trip Report #{{ $schedule->id }}</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=El+Messiri:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

    /* font-family: "Roboto", sans-serif; */
    /* font-family: "El Messiri", sans-serif; */
    /* ===== Base Styles ===== */
    @page {
      margin: 40px 40px;
    }

    body {
      /* font-family: "DejaVu Sans", sans-serif; */
      color: #222;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .report-container {
      background: #fff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* ===== Header ===== */
    .header {
      text-align: center;
      border-bottom: 3px solid #ff0000;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }

    .header h1 {
      font-family: "El Messiri", sans-serif;
      margin: 0;
      padding: 0;
      font-size: 28px;
      letter-spacing: 1px;
      color: #780116;
    }

    .header p {
      font-size: 13px;
      color: #555;
    }

    /* ===== Section Titles ===== */
    .section-title {
      font-size: 16px;
      font-weight: 700;
      background: #780116;
      color: #fff;
      padding: 6px 10px;
      border-radius: 4px;
      text-transform: uppercase;
      margin-top: 25px;
      margin-bottom: 10px;
    }

    /* ===== Info Tables ===== */
    .info-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .info-table th,
    .info-table td {
      padding: 10px 8px;
      border: 1px solid #ccc;
      vertical-align: middle;
    }

    .info-table th {
      background-color: #fffffc;
      color: #780116;
      font-weight: 600;
      width: 30%;
    }

    .info-table td {
      background-color: #fff;
    }

    .highlight {
      color: #ff0000;
      font-weight: 700;
    }

    /* ===== Signature Section ===== */
    .signature-section {
      display: flex;
      justify-content: space-between;
      margin-top: 50px;
      gap: 20px;
    }

    .signature {
      width: 45%;
      text-align: center;
      border-top: 2px solid #000;
      padding-top: 8px;
      font-size: 14px;
      font-weight: 500;
    }

    .signature small {
      color: #666;
    }

    /* ===== Footer ===== */
    .footer {
      text-align: center;
      font-size: 12px;
      margin-top: 40px;
      color: #666;
      border-top: 1px solid #ddd;
      padding-top: 8px;
    }

    /* ===== Responsive ===== */
    @media print {
      body {
        background: none;
      }

      .report-container {
        box-shadow: none;
        border: none;
        padding: 0;
      }

      .section-title {
        background: #780116 !important;
        color: #fff !important;
      }
    }
  </style>
</head>

<body>
  <div class="report-container">
    <!-- ===== Header ===== -->
    <div class="header">
      <h1>RunStar</h1>
      <h4>Trip Report</h4>
      <p>Generated on {{ now()->timezone('Asia/Dhaka')->format('d M Y, h:i A') }}</p>
    </div>

    <!-- ===== Trip Details ===== -->
    <div class="section-title">Trip Details</div>
    <table class="info-table">
      <tr>
        <th>Trip ID</th>
        <td>#{{ $schedule->id }}</td>
      </tr>
      <tr>
        <th>Date</th>
        <td>{{ $schedule->set_date }}</td>
      </tr>
      <tr>
        <th>Time</th>
        <td>{{ $schedule->set_time }}</td>
      </tr>
      <tr>
        <th>Route</th>
        <td>{{ $schedule->route_code }}</td>
      </tr>
      <tr>
        <th>Start Location</th>
        <td>{{ $schedule->start_location }}</td>
      </tr>
      <tr>
        <th>End Location</th>
        <td>{{ $schedule->end_location }}</td>
      </tr>
      <tr>
        <th>Bus Type</th>
        <td>{{ $schedule->bus_type }}</td>
      </tr>
      <tr>
        <th>Coach Number</th>
        <td>{{ $schedule->coach_no }}</td>
      </tr>
      <tr>
        <th>Status</th>
        <td class="highlight" style="text-transform: capitalize;">
          {{ $schedule->status }}
        </td>
      </tr>
      <tr>
        <th>Driver</th>
        <td>{{ $schedule->driver?->name ?? 'Not Assigned' }}</td>
      </tr>
      <tr>
        <th>Supervisor</th>
        <td>{{ $schedule->supervisor?->name ?? 'Not Assigned' }}</td>
      </tr>
    </table>

    <!-- ===== Passenger Summary ===== -->
    <div class="section-title">Passenger Summary</div>
    <table class="info-table">
      <tr>
        <th>Total Passengers</th>
        <td><strong>{{ $totalPassengers }}</strong></td>
      </tr>
      <tr>
        <th>Booked Seats</th>
        <td>
          {{ $bookedSeats->pluck('booked_seats')->implode(', ') }}
        </td>
      </tr>
    </table>

    <!-- ===== Signatures ===== -->
    <div class="signature-section">
      {{-- <div class="signature">
        Manager Signature<br><small>(Trip Manager)</small>
      </div> --}}
      <div class="signature">
        Controller Signature<br><small>(Bus Controller)</small>
      </div>
    </div>

    <!-- ===== Footer ===== -->
    <div class="footer">
      Transport Management System — Automated Trip Report
    </div>
  </div>
</body>

</html>