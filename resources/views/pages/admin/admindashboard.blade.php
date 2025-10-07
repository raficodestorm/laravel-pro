@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid">
  <div class="row g-2">
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Passenger</h5>
        <h2>1500p</h2>
        <p>in september</p>
      </div>
    </div>
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Sale</h5>
        <h2>85000tk</h2>
        <p>in september</p>
      </div>
    </div>
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Return</h5>
        <h2>100 pc</h2>
        <p>in september</p>
      </div>
    </div>
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Cost</h5>
        <h2>9500tk</h2>
        <p>in september</p>
      </div>
    </div>
  </div>

<!-- Sale Chart -->
<div class="container-fluid">
  <div class="row g-2">
    <div class="col-md-6 p-2">
      <div class="graph p-2">
        <div class="chart-container">
          <h4 class="chart-title">Monthly Bookings Overview</h4>
          <canvas id="monthlyChart" height="350"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6 p-2">
      <div class="graph p-2">
        <div class="top-saler-container">
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
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById("monthlyChart");

  new Chart(ctx, {
    type: "bar",
    data: {
      labels: [
        "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
      ],
      datasets: [{
        label: "Bookings",
        data: [120, 95, 110, 130, 125, 140, 100, 115, 90, 105, 98, 150],
        backgroundColor: "#ff0000",
        borderRadius: 5,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          grid: { color: "#eee" }
        },
        x: {
          grid: { display: false }
        }
      },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: "#2c3e50",
          titleColor: "#fff",
          bodyColor: "#fff"
        }
      }
    }
  });
});
</script>
@endsection


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/sales.js') }}"></script>
@endsection
