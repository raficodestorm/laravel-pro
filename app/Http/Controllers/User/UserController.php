<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class UserController extends Controller
{
  public function myTickets()
  {
    $tickets = auth()->user()
      ->tickets()
      ->with('reservation.schedule')
      ->latest()
      ->paginate(10);

    return view('pages.user.my-tickets', compact('tickets'));
  }

  public function viewTicket(Ticket $ticket)
  {
    $bookingData = $ticket->reservation()->with('schedule')->first();

    return view('pages.user.ticket', compact('bookingData'))
      ->with('pnr', $ticket->pnr);
  }
}
