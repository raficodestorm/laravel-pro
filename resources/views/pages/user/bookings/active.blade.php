@extends('layouts.userlayout')

@section('content')
<style>
  :root {
    --main-color: #ff0000;
    --second-color: #780116;
    --section-bg-color: #fffffc;
    --light-bg: #f9f9f9;
    --text-color: #220901;
    --hover-color: #ff4d4d;
    --shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  }

  /* ========= Container & Page Layout ========= */
  .page-container {
    padding: 50px 15px;
    background-color: var(--section-bg-color);
    min-height: 100vh;
  }

  h4.page-title {
    color: var(--second-color);
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
  }

  /* ========= Table Styling ========= */
  .table-container {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: 0.3s ease;
  }

  .table-container:hover {
    box-shadow: 0 6px 18px rgba(255, 0, 0, 0.15);
  }

  table.table {
    margin: 0;
    border-collapse: collapse;
    width: 100%;
  }

  table.table th {
    background-color: var(--main-color);
    color: #fff;
    font-weight: 600;
    padding: 14px 10px;
    text-transform: uppercase;
    font-size: 0.9rem;
    border: none;
  }

  table.table td {
    padding: 14px 10px;
    color: var(--text-color);
    vertical-align: middle;
    font-size: 0.95rem;
  }

  table.table tr:nth-child(even) {
    background-color: #fdf5f5;
  }

  table.table tr:hover {
    background-color: #ffeaea;
    transition: 0.3s ease;
  }

  /* ========= Buttons ========= */
  .btn-action {
    display: inline-block;
    background-color: var(--main-color);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 8px 14px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .btn-action:hover {
    background-color: var(--second-color);
    color: #fff;
    transform: translateY(-2px);
  }

  /* ========= Badges ========= */
  .badge {
    border-radius: 20px;
    padding: 6px 12px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
  }

  .badge-success {
    background-color: #06d6a0;
    color: #fff;
  }

  .badge-warning {
    background-color: #ffd166;
    color: #000;
  }

  .badge-danger {
    background-color: #ef476f;
    color: #fff;
  }

  .badge-info {
    background-color: #118ab2;
    color: #fff;
  }

  /* ========= Pagination ========= */
  .pagination {
    justify-content: center;
    margin-top: 20px;
  }

  .pagination .page-item .page-link {
    color: var(--main-color);
    border-radius: 6px;
    border: 1px solid var(--main-color);
    margin: 0 3px;
    transition: 0.3s;
  }

  .pagination .page-item.active .page-link {
    background-color: var(--main-color);
    color: #fff;
    border-color: var(--main-color);
  }

  .pagination .page-item .page-link:hover {
    background-color: var(--second-color);
    color: #fff;
  }

  /* ========= Empty State ========= */
  .alert-info {
    background-color: #fff5f5;
    color: var(--second-color);
    border: 1px solid var(--main-color);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    font-weight: 500;
  }

  /* ========= Responsive Design ========= */
  @media (max-width: 992px) {
    h4.page-title {
      font-size: 1.4rem;
      margin-bottom: 20px;
    }

    table.table th,
    table.table td {
      font-size: 0.9rem;
      padding: 10px 8px;
    }

    .btn-action {
      padding: 6px 10px;
      font-size: 0.8rem;
    }
  }

  @media (max-width: 768px) {
    .table-responsive {
      border-radius: 10px;
      box-shadow: var(--shadow);
    }

    table.table {
      font-size: 0.85rem;
    }

    table.table th {
      font-size: 0.8rem;
      text-transform: capitalize;
    }

    h4.page-title {
      font-size: 1.3rem;
    }
  }

  @media (max-width: 576px) {
    .page-container {
      padding: 30px 10px;
    }

    h4.page-title {
      font-size: 1.1rem;
    }

    table.table th,
    table.table td {
      padding: 8px 6px;
      font-size: 0.8rem;
    }

    .btn-action {
      padding: 6px 8px;
      font-size: 0.75rem;
    }
  }
</style>

<div class="container my-5">
  <h4 class="mb-4 text-main fw-bold">🚌 Active Bookings</h4>

  @if($reservations->count())
  <div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
      <thead style="background-color: var(--second-color); color: var(--section-bg-color);">
        <tr>
          <th>PNR</th>
          <th>Journey Date</th>
          <th>Route</th>
          <th>Seats</th>
          <th>Total</th>
          <th>Schedule Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reservations as $res)
        <tr>
          <td>{{ $res->pnr }}</td>
          <td>{{ \Carbon\Carbon::parse($res->schedule->set_date)->format('d M Y') }}</td>
          <td>{{ $res->route->name ?? 'N/A' }}</td>
          <td>{{ $res->selected_seats }}</td>
          <td>৳ {{ number_format($res->total, 2) }}</td>
          <td>
            <span class="badge bg-success">{{ ucfirst($res->schedule->status) }}</span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $reservations->links() }}
  </div>
  @else
  <div class="alert alert-info">No active bookings found.</div>
  @endif
</div>
@endsection