@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid">
  <div class="row g-2">
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Passenger</h5>
        <h2>1500p</h2>
        <p>in september</p>
        <div class="style-hello"></div>
      </div>
    </div>
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Sale</h5>
        <h2>85000tk</h2>
        <p>in september</p>
        <div class="style-hello"></div>
      </div>
    </div>
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Return</h5>
        <h2>100 pc</h2>
        <p>in september</p>
        <div class="style-hello"></div>
      </div>
    </div>
    <div class="col-md-3 p-2">
      <div class="hello p-2">
        <h5>Cost</h5>
        <h2>9500tk</h2>
        <p>in september</p>
        <div class="style-hello"></div>
      </div>
    </div>
  </div>

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
    </div>


  </div>
  @endsection


  @section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @endsection