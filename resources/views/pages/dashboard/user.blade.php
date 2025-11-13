@extends('layouts.userlayout')

<x-auth-session-status class="mb-4" :status="session('status')" />

@section('content')
<style>
  :root {
    --main-color: #ff0000;
    --second-color: #780116;
    --bg-color: #fffffc;
    --back-color: #edf6f9af;
    --text-color: #220901;
    --light-hover: #ff0101ca;
  }

  /* ==== DASHBOARD BASE ==== */
  .dashboard-container {
    padding: 50px 0;
  }

  .dashboard-header {
    text-align: center;
    margin-bottom: 50px;
  }

  .dashboard-header h2 {
    font-weight: 700;
    color: var(--second-color);
    font-size: 2rem;
  }

  .dashboard-header p {
    color: var(--text-color);
    opacity: 0.8;
  }

  /* ==== SUMMARY CARDS ==== */
  .summary-card {
    border: none;
    border-radius: 16px;
    background-color: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
    height: 100%;
  }

  .summary-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 5px;
    height: 100%;
    background-color: var(--main-color);
    transition: width 0.3s ease, background-color 0.3s ease;
  }

  .summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(255, 0, 0, 0.15);
  }

  .summary-card:hover::before {
    width: 7px;
    background-color: var(--light-hover);
  }

  .summary-card .card-body {
    padding: 25px 30px;
  }

  .summary-icon {
    font-size: 2.2rem;
    color: var(--main-color);
    margin-bottom: 10px;
  }

  .summary-card h5 {
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: capitalize;
  }

  .summary-card p {
    font-size: 1rem;
    color: var(--second-color);
    font-weight: 500;
    margin: 0;
  }

  .summary-card a {
    text-decoration: none;
    color: inherit;
  }

  .summary-card a:hover h5 {
    color: var(--main-color);
  }

  /* ==== SUPPORT SECTION ==== */
  .support-section {
    margin-top: 60px;
    background-color: var(--back-color);
    border-radius: 14px;
    padding: 35px 25px;
    text-align: center;
  }

  .support-section h4 {
    color: var(--second-color);
    font-weight: 700;
    margin-bottom: 10px;
  }

  .support-section p {
    color: var(--text-color);
    opacity: 0.9;
  }

  .btn-support {
    background-color: var(--main-color);
    color: #fff;
    border-radius: 10px;
    transition: 0.3s;
    padding: 10px 20px;
    font-weight: 500;
  }

  .btn-support:hover {
    background-color: var(--light-hover);
    color: #fff;
    transform: translateY(-2px);
  }

  /* ==== RESPONSIVE DESIGN ==== */
  @media (max-width: 992px) {
    .dashboard-header h2 {
      font-size: 1.6rem;
    }

    .summary-card .card-body {
      padding: 20px;
    }

    .summary-icon {
      font-size: 1.9rem;
    }
  }

  @media (max-width: 768px) {
    .dashboard-header h2 {
      font-size: 1.4rem;
    }

    .dashboard-container {
      padding: 30px 0;
    }

    .summary-card h5 {
      font-size: 1rem;
    }

    .summary-card p {
      font-size: 0.95rem;
    }
  }

  @media (max-width: 576px) {
    .summary-card {
      margin-bottom: 15px;
    }

    .support-section {
      text-align: left;
      padding: 25px 20px;
    }
  }
</style>

<div class="container dashboard-container">
  <div class="dashboard-header">
    <h2>Welcome Back, {{ Auth::user()->username ?? 'User' }} 👋</h2>
    <p>Here’s an overview of your bus travel activity</p>
  </div>

  {{-- Summary Cards --}}
  <div class="row g-4 justify-content-center">

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-ticket-detailed-fill"></i></div>
          <a href="{{ route('user.mytickets') }}">
            <h5>My Tickets</h5>
          </a>
          <p>View / Download Tickets</p>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <a href="{{ route('user.bookings.active') }}">
          <div class="card-body">
            <div class="summary-icon"><i class="bi bi-bus-front-fill"></i></div>
            <h5>Active Bookings</h5>
            <p>{{ $paidBookings ?? 0 }} Paid Booking(s)</p>
          </div>
        </a>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <a href="{{ route('user.bookings.pending') }}">
          <div class="card-body">
            <div class="summary-icon"><i class="bi bi-hourglass-split"></i></div>
            <h5>Pending Payments</h5>
            <p>{{ $pendingBookings ?? 0 }} Booking(s) Awaiting Payment</p>
          </div>
        </a>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <a href="{{ route('user.trips.upcoming') }}">
          <div class="summary-icon"><i class="bi bi-calendar-event"></i></div>
          <h5>Upcoming Trips</h5>
          <p>{{ $upcomingTrips ?? 0 }}</p>
        </a>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="summary-icon"><i class="bi bi-play-circle"></i></div>
        <h5>Running Trips</h5>
        <p>{{ $runningTrips ?? 0 }}</p>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <a href="{{ route('user.trips.completed') }}">
          <div class="summary-icon"><i class="bi bi-check-circle"></i></div>
          <h5>Completed Trips</h5>
          <p>{{ $completedTrips ?? 0 }}</p>
        </a>
      </div>
    </div>
  </div>

  {{-- Support & Help --}}
  <div class="support-section mt-5">
    <h4><i class="bi bi-headset"></i> Support & Help</h4>
    <p>If you face any issues or have questions about your bookings, our support team is always here for you.</p>
    <a href="#" class="btn btn-support mt-2">
      <i class="bi bi-chat-dots"></i> Contact Support
    </a>
  </div>
</div>
@endsection