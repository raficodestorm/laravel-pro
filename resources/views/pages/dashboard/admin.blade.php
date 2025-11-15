@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid">
  <div class="row g-2">

    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Passenger</h5>
        <h2>{{ $totalPassengersThisMonth }}p</h2>
        <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
        <div class="style-hello"></div>
      </div>
    </div>

    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Sale</h5>
        <h2>{{ $totalamountThisMonth }} Tk</h2>
        <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
        <div class="style-hello"></div>
      </div>
    </div>

    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Completed Trips</h5>
        <h2>{{ $totalTripsThisMonth }}</h2>
        <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
        <div class="style-hello"></div>
      </div>
    </div>

    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Cost</h5>
        <h2>3500tk</h2>
        <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
        <div class="style-hello"></div>
      </div>
    </div>

  </div>{{-- end row --}}

  <!-- Sale Chart -->

  <div class="row g-2">
    <div class="col-md-6 p-2 p-grap ">
      <div class=" graph p-2">
        <div class="chart-container">
          <h4 class="chart-title text-center">Monthly Bookings Overview</h4>
          <canvas id="monthlyChart"></canvas>
        </div>
        <div class="style-hello-graph"></div>
      </div>
    </div>

    <div class="col-md-6 p-2 p-top-saler">
      <div class="top-saler p-2">
        <h4 class="top-saler-table-title mb-4">🏆 Top 5 Branches</h4>
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>Branch</th>
              <th>Manager</th>
              <th class="top-saler-text-center">Sales</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Dhaka Central</td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/50?img=1" alt="S A Rafi" class="top-saler-profile-pic" />
                  <span class="ms-2">S A Rafi</span>
                </div>
              </td>
              <td class="text-center fw-bold top-saler-text-main">1,200+</td>
            </tr>

            <tr>
              <td>Chittagong Hub</td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/50?img=2" alt="Rasel Khan" class="top-saler-profile-pic" />
                  <span class="ms-2">Rasel Khan</span>
                </div>
              </td>
              <td class="text-center fw-bold top-saler-text-main">1,100+</td>
            </tr>

            <tr>
              <td>Sylhet Point</td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/50?img=3" alt="Mehedi Hasan" class="top-saler-profile-pic" />
                  <span class="ms-2">Mehedi Hasan</span>
                </div>
              </td>
              <td class="text-center fw-bold top-saler-text-main">980+</td>
            </tr>

            <tr>
              <td>Rajshahi Zone</td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/50?img=4" alt="Anis Khan" class="top-saler-profile-pic" />
                  <span class="ms-2">Anis Khan</span>
                </div>
              </td>
              <td class="text-center fw-bold top-saler-text-main">920+</td>
            </tr>

            <tr>
              <td>Khulna Station</td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="https://i.pravatar.cc/50?img=5" alt="Tariq Rahman" class="top-saler-profile-pic" />
                  <span class="ms-2">Tariq Rahman</span>
                </div>
              </td>
              <td class="text-center fw-bold top-saler-text-main">850+</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="style-hello-topsale"></div>
    </div>{{-- end row --}}



    <div class="row g-2">

      <div class="col-md-3 p-2">
        <div class="hello p-2">
          <h5>Passenger</h5>
          <h2>{{ $totalPassengersThisMonth }}p</h2>
          <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
          <div class="style-hello"></div>
        </div>
      </div>

      <div class="col-md-3 p-2">
        <div class="hello p-2">
          <h5>Sale</h5>
          <h2>{{ $totalamountThisMonth }} Tk</h2>
          <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
          <div class="style-hello"></div>
        </div>
      </div>

      <div class="col-md-3 p-2">
        <div class="hello p-2">
          <h5>Completed Trips</h5>
          <h2>{{ $totalTripsThisMonth }}</h2>
          <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
          <div class="style-hello"></div>
        </div>
      </div>

      <div class="col-md-3 p-2">
        <div class="hello p-2">
          <h5>Cost</h5>
          <h2>9500tk</h2>
          <p>in {{ \Carbon\Carbon::now()->format('F') }}</p>
          <div class="style-hello"></div>
        </div>
      </div>

    </div> {{-- end row --}}

    <div class="row g-2 mx-1 mb-3">
      <div class="index-card shadow">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3>All bookings</h3>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle" id="table-same">
          <thead class="table-dark text-center">
            <tr>
              <th>ID</th>
              <th>Passenger</th>
              <th>Schedule id</th>
              <th>Coach no</th>
              <th>Route</th>
              <th>Seats</th>
              <th>Total</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($reservations as $reserve)
            <tr class="text-center">
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $reserve->name }}</td>
              <td>{{ $reserve->schedule_id }}</td>
              <td>{{ $reserve->coach_no }}</td>
              <td>{{ $reserve->route }}</td>
              <td>{{ $reserve->selected_seats }}</td>
              <td>{{ $reserve->total }}</td>
              <td class="badge bg-info">{{ $reserve->status }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center text-muted">No locations found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>

        {{ $reservations->links() }}
      </div>
    </div>

  </div> {{-- end container --}}
  @endsection


  @section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @endsection