<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Trip Report #{{ $schedule->id }}</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      color: #333;
    }

    .header {
      text-align: center;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .header h1 {
      margin: 0;
      font-size: 24px;
      text-transform: uppercase;
    }

    .info-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .info-table th,
    .info-table td {
      border: 1px solid #aaa;
      padding: 8px;
      font-size: 14px;
    }

    .info-table th {
      background: #f2f2f2;
      text-align: left;
    }

    .section-title {
      background: #eee;
      padding: 6px 10px;
      font-weight: bold;
      border-left: 4px solid #007bff;
      margin-top: 20px;
    }

    .signature-section {
      margin-top: 40px;
      display: flex;
      justify-content: space-between;
    }

    .signature {
      width: 45%;
      text-align: center;
      border-top: 1px solid #000;
      padding-top: 10px;
      font-size: 14px;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      margin-top: 20px;
      color: #666;
    }
  </style>
</head>

<body>

  <div class="header">
    <h1>Trip Report</h1>
    <p>Generated on {{ now()->format('d M, Y h:i A') }}</p>
  </div>

  <h3>Trip Details</h3>
  <table class="info-table">
    <tr>
      <th>Trip ID</th>
      <td>{{ $schedule->id }}</td>
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
      <th>Start</th>
      <td>{{ $schedule->start_location }}</td>
    </tr>
    <tr>
      <th>End</th>
      <td>{{ $schedule->end_location }}</td>
    </tr>
    <tr>
      <th>Bus Type</th>
      <td>{{ $schedule->bus_type }}</td>
    </tr>
    <tr>
      <th>Coach No</th>
      <td>{{ $schedule->coach_no }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td style="text-transform:capitalize;">{{ $schedule->status }}</td>
    </tr>
    <tr>
      <th>Driver</th>
      <td>{{ $schedule->driver ? $schedule->driver->name : 'Not Assigned' }}</td>
    </tr>
    <tr>
      <th>Supervisor</th>
      <td>{{ $schedule->supervisor ? $schedule->supervisor->name : 'Not Assigned' }}</td>
    </tr>

  </table>

  <h3>Passenger Summary</h3>
  <table class="info-table">
    <tr>
      <th>Total Passengers</th>
      <td>{{ $totalPassengers }}</td>
    </tr>
    <tr>
      <th>Total Seats Booked</th>
      <td>
        {{ $bookedSeats->pluck('booked_seats')->implode(', ') }}
      </td>
    </tr>
  </table>


  <div class="signature-section">
    <div class="signature">
      Manager Signature<br><small>(Trip Manager)</small>
    </div>
    <div class="signature">
      Controller Signature<br><small>(Bus Controller)</small>
    </div>
  </div>

  <div class="footer">
    <p>Transport Management System — Trip Report generated automatically.</p>
  </div>

</body>

</html>