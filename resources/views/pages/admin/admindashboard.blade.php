@extends('layouts.adminlayout')

@section('content')
<div className="container-fluid">
  <div className="row g-2">
    <div className="col-md-3 p-2">
      <div className="hello p-2">
        <h5>Passenger</h5>
        <h2>1500p</h2>
        <p>in september</p>
      </div>
    </div>
    <div className="col-md-3 p-2">
      <div className="hello p-2">
        <h5>Sale</h5>
        <h2>85000tk</h2>
        <p>in september</p>
      </div>
    </div>
    <div className="col-md-3 p-2">
      <div className="hello p-2">
        <h5>Return</h5>
        <h2>100 pc</h2>
        <p>in september</p>
      </div>
    </div>
    <div className="col-md-3 p-2">
      <div className="hello p-2">
        <h5>Cost</h5>
        <h2>9500tk</h2>
        <p>in september</p>
      </div>
    </div>
  </div>

  <div className="row g-2">
    <div className="col-md-6 p-2">
      <div className="graph p-2">
        <div class="chart-container">
          <h4 class="chart-title">Monthly Bookings Overview</h4>
          <canvas id="monthlyChart"></canvas>
        </div>
      </div>
    </div>
    <div className="col-md-6 p-2">
      <div className="graph p-2">
        <div class="top-saler-container">
          <h4 class="top-saler-table-title mb-4">🏆 Top 5 Selling Products</h4>

          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>Product</th>
                <th>Brand</th>
                <th class="text-center">Sales</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Wireless Headphones</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                      src="https://i.pravatar.cc/50?img=10"
                      alt="Sony"
                      class="top-saler-profile-pic" />
                    <span class="ms-2">Sony</span>
                  </div>
                </td>
                <td class="text-center top-saler-text-main">2,400+</td>
              </tr>

              <tr>
                <td>Smart Watch</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                      src="https://i.pravatar.cc/50?img=11"
                      alt="Apple"
                      class="top-saler-profile-pic" />
                    <span class="ms-2">Apple</span>
                  </div>
                </td>
                <td class="text-center top-saler-text-main">2,100+</td>
              </tr>

              <tr>
                <td>Bluetooth Speaker</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                      src="https://i.pravatar.cc/50?img=12"
                      alt="JBL"
                      class="top-saler-profile-pic" />
                    <span class="ms-2">JBL</span>
                  </div>
                </td>
                <td class="text-center top-saler-text-main">1,800+</td>
              </tr>

              <tr>
                <td>Gaming Mouse</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                      src="https://i.pravatar.cc/50?img=13"
                      alt="Logitech"
                      class="top-saler-profile-pic" />
                    <span class="ms-2">Logitech</span>
                  </div>
                </td>
                <td class="text-center top-saler-text-main">1,650+</td>
              </tr>

              <tr>
                <td>4K Monitor</td>
                <td>
                  <div class="d-flex align-items-center">
                    <img
                      src="https://i.pravatar.cc/50?img=14"
                      alt="Samsung"
                      class="top-saler-profile-pic" />
                    <span class="ms-2">Samsung</span>
                  </div>
                </td>
                <td class="text-center top-saler-text-main">1,500+</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


</div>

@endsection