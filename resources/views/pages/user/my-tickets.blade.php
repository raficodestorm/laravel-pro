@extends('layouts.userlayout')

@section('content')
<style>
  :root {
    --main-color: #ff0000;
    --second-color: #780116;
    --section-bg-color: #fffffc;
  }

  .tickets-container {
    background: var(--section-bg-color);
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    padding: 2rem;
  }

  .tickets-title {
    color: var(--second-color);
    font-weight: 700;
    font-size: 1.5rem;
  }

  /* Table Styling */
  .table {
    border-radius: 12px;
    overflow: hidden;
  }

  .table thead {
    background-color: var(--main-color);
    color: #fff;
    font-weight: 600;
  }

  .table tbody tr {
    transition: background-color 0.3s ease;
  }

  .table tbody tr:hover {
    background-color: rgba(255, 0, 0, 0.05);
  }

  .btn-primary {
    background-color: var(--main-color);
    border: none;
    transition: all 0.3s ease;
  }

  .btn-primary:hover {
    background-color: var(--second-color);
  }

  /* Pagination */
  .pagination {
    justify-content: center;
  }

  .page-item.active .page-link {
    background-color: var(--main-color);
    border-color: var(--main-color);
  }

  .page-link {
    color: var(--second-color);
  }

  .page-link:hover {
    color: var(--main-color);
  }

  /* Responsive Table */
  @media (max-width: 768px) {
    .table-responsive {
      border: none;
    }

    .table thead {
      display: none;
    }

    .table tbody tr {
      display: block;
      margin-bottom: 1rem;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      padding: 1rem;
    }

    .table td {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.5rem 0;
      border: none;
    }

    .table td::before {
      content: attr(data-label);
      font-weight: 600;
      color: var(--second-color);
      flex-basis: 45%;
      text-align: left;
    }

    .table td:last-child {
      justify-content: center;
      padding-top: 1rem;
    }
  }
</style>

<div class="container my-5">
  <div class="tickets-container">
    <h4 class="mb-4 tickets-title">🎫 My Tickets</h4>

    @if($tickets->count())
    <div class="table-responsive">
      <table class="table table-bordered text-center align-middle">
        <thead>
          <tr>
            <th>PNR</th>
            <th>Journey Date</th>
            <th>Route</th>
            <th>Seats</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tickets as $ticket)
          <tr>
            <td data-label="PNR">{{ $ticket->pnr }}</td>
            <td data-label="Journey Date">{{
              \Carbon\Carbon::parse($ticket->reservation->schedule->set_date)->format('d/m/y') }}</td>
            <td data-label="Route">{{ $ticket->reservation->route }}</td>
            <td data-label="Seats">{{ $ticket->reservation->selected_seats }}</td>
            <td data-label="Total">৳ {{ number_format($ticket->reservation->total, 2) }}</td>
            <td data-label="Action">
              <a href="{{ route('user.ticket.view', $ticket->id) }}" class="btn btn-sm btn-primary">
                View / Download
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $tickets->links() }}
    </div>

    @else
    <div class="alert alert-info text-center mt-3">
      You don’t have any tickets yet.
    </div>
    @endif
  </div>
</div>
@endsection