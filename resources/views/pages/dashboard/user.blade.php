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

  body {
    background-color: var(--bg-color);
    color: var(--text-color);
  }

  .dashboard-container {
    padding: 40px 0;
  }

  .dashboard-header {
    text-align: center;
    margin-bottom: 40px;
  }

  .dashboard-header h2 {
    font-weight: 700;
    color: var(--second-color);
  }

  .summary-card {
    border: none;
    border-radius: 16px;
    background-color: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
  }

  .summary-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background-color: var(--main-color);
    transition: 0.3s;
  }

  .summary-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(255, 0, 0, 0.2);
  }

  .summary-card:hover::before {
    width: 6px;
    background-color: var(--light-hover);
  }

  .summary-card .card-body {
    padding: 25px 30px;
  }

  .summary-icon {
    font-size: 2rem;
    color: var(--main-color);
    margin-bottom: 15px;
  }

  .summary-card h5 {
    font-weight: 600;
    margin-bottom: 10px;
  }

  .summary-card p {
    font-size: 1.1rem;
    color: var(--second-color);
    font-weight: 500;
  }

  .support-section {
    margin-top: 50px;
    background-color: var(--back-color);
    border-radius: 12px;
    padding: 30px;
  }

  .support-section h4 {
    color: var(--second-color);
    font-weight: 600;
  }

  .btn-support {
    background-color: var(--main-color);
    color: #fff;
    border-radius: 8px;
    transition: background-color 0.3s ease;
  }

  .btn-support:hover {
    background-color: var(--light-hover);
    color: #fff;
  }
</style>

<div class="container dashboard-container">
  <div class="dashboard-header">
    <h2>Welcome Back, {{ Auth::user()->username ?? 'User' }} 👋</h2>
    <p>Here’s an overview of your bus travel activity</p>
  </div>

  {{-- Summary Cards --}}
  <div class="row g-4">
    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-bus-front-fill"></i></div>
          <h5>Active Bookings</h5>
          <p>Active Bookings Active Bookings Active Bookings</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-calendar-check-fill"></i></div>
          <h5>Upcoming Trips</h5>
          <p>Upcoming Trips Upcoming Trips Upcoming Trips</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-check2-circle"></i></div>
          <h5> Completed Trips</h5>
          <p>Completed Trips Completed Trips Completed Trips</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-hourglass-split"></i></div>
          <h5>Pending Payments</h5>
          <p>Pending Payments Pending Payments Pending Payments</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-wallet2"></i></div>
          <h5>Wallet Balance</h5>
          <p>Wallet Balance Wallet Balance</p>
        </div>
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





{{-- <div class="container dashboard-container">
  <div class="dashboard-header">
    <h2>Welcome Back, {{ Auth::user()->name ?? 'User' }} 👋</h2>
    <p>Here’s an overview of your bus travel activity</p>
  </div>


  <div class="row g-4">
    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-bus-front-fill"></i></div>
          <h5>Active Bookings</h5>
          <p>{{ $activeBookings ?? 0 }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-calendar-check-fill"></i></div>
          <h5>Upcoming Trips</h5>
          <p>{{ $upcomingTrips ?? 0 }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-check2-circle"></i></div>
          <h5>Completed Trips</h5>
          <p>{{ $completedTrips ?? 0 }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-hourglass-split"></i></div>
          <h5>Pending Payments</h5>
          <p>{{ $pendingPayments ?? 0 }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-lg-3">
      <div class="card summary-card text-center">
        <div class="card-body">
          <div class="summary-icon"><i class="bi bi-wallet2"></i></div>
          <h5>Wallet Balance</h5>
          <p>৳{{ number_format($walletBalance ?? 0, 2) }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="support-section mt-5">
    <h4><i class="bi bi-headset"></i> Support & Help</h4>
    <p>If you face any issues or have questions about your bookings, our support team is always here for you.</p>
    <a href="{{ route('user.support') }}" class="btn btn-support mt-2">
      <i class="bi bi-chat-dots"></i> Contact Support
    </a>
  </div>
</div> --}}