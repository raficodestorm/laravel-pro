@extends('layouts.userlayout')

@section('content')
<div class="container seat-reservation">
  <div class="row">
    {{-- LEFT SIDE - Seat Layout --}}
    <div class="col-md-6">
      <div class="col-md-12 legend">
        <span class="seat soldM">Booked</span>
        <span class="seat blocked">Blocked</span>
        <span class="seat available">Available</span>
        <span class="seat selected">Selected</span>
      </div>

      <div class="bus-container">
        {{-- Top row: Door + Driver --}}
        <div class="bus-front">
          <div class="door">Door</div>
          <div class="driver" onclick="playHorn()" style="cursor:pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" height="35px" viewBox="0 -960 960 960" width="35px">
              <path
                d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm-40-84v-120q-60-12-102-54t-54-102H164q12 109 89.5 185T440-164Zm80 0q109-12 186.5-89.5T796-440H676q-12 60-54 102t-102 54v120ZM164-520h116l120-120h160l120 120h116q-15-121-105-200.5T480-800q-121 0-211 79.5T164-520Z" />
            </svg>
          </div>
        </div>

        {{-- Seat Layout --}}
        <div class="seats" id="seat-layout"></div>

        {{-- Footer --}}
        <div class="summary">
          <h4>Selected Seats:</h4>
          <p id="selected-seats">None</p>
        </div>
      </div>
    </div>

    {{-- RIGHT SIDE - Reservation Form --}}
    <div class="col-md-6">
      <div class="reservation-form">
        <form id="reservationForm" action="{{ route('go.payment') }}" method="POST">
          @csrf
          <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">

          <h4 class="mb-3 text-center" style="color:#780116;">BUS INFORMATION</h4>
          <div class="ticket-card p-3 mb-3">
            <p class="inline"><strong>Bus type:</strong></p>
            <input class="hidein" type="text" name="bus_type" value="{{ $schedule->bus_type }}" readonly><br>
            <p class="inline"><strong>Coach No:</strong></p>
            <input class="hidein" type="text" name="coach_no" value="{{ $schedule->coach_no }}" readonly><br>
            <p class="inline"><strong>Route:</strong></p>
            <input class="hidein" type="text" name="route"
              value="{{ $schedule->start_location }} to {{ $schedule->end_location }}" readonly> <br>

            <p class="inline"><strong>Fare per Seat: ৳</strong></p>
            <input class="hidein" type="text" name="seat_price" value="{{ number_format($schedule->price, 2) }}"
              readonly> <br>
            <p class="inline"><strong>Departure:</strong></p>
            <input class="hidein" type="text" name="departure"
              value="{{ date('h:i A', strtotime($schedule->set_time)) }}" readonly>
          </div>

          <h4>SEAT INFORMATION:</h4>
          <span>Selected Seats:</span>
          <input type="text" id="selectedSeatsInput" name="selected_seats" readonly>

          <span>Total amount:</span>
          <input type="text" id="totalAmount" name="total" readonly>

          <h4 style="margin-top:3rem;">BOARDING/DROPPING:</h4>
          <select name="boarding" required>
            <option value="">Select boarding point</option>
            @foreach($boardingCounters as $counter)
            <option value="{{ $counter->location }}">
              {{ $counter->location }}
            </option>
            @endforeach
          </select>

          <select name="dropping" required>
            <option value="">Select dropping point</option>
            @foreach($droppingCounters as $counter)
            <option value="{{ $counter->location }}">
              {{ $counter->location }}
            </option>
            @endforeach
          </select>

          <input type="text" name="name" placeholder="Your Name*" required>
          <input type="text" name="mobile" placeholder="Mobile Number*" required>

          <button type="submit" class="submit-btn" onclick="playHorn()" style="cursor:pointer;">
            SUBMIT
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- JavaScript for seat logic --}}
<script>
  const seatLayout = "{{ $seatLayout }}";  
  const seatCapacity = Number("{{ $seatCapacity }}");
  const busType = "{{ $bustype }}";
  const seatPrice = {{ $schedule->price }};

  const selectedSeats = [];
  const seatContainer = document.getElementById("seat-layout");
  const selectedSeatsDisplay = document.getElementById("selected-seats");
  const selectedSeatsInput = document.getElementById("selectedSeatsInput");
  const totalAmount = document.getElementById("totalAmount");

  function generateDynamicSeats() {
    const [left, right] = seatLayout.split(":").map(Number);
    const seatsPerRow = left + right;

    // total rows required
    const totalRows = Math.ceil(seatCapacity / seatsPerRow);

    let currentSeatCount = 0; // Tracks how many seats created total

    for (let row = 0; row < totalRows; row++) {
      const rowDiv = document.createElement("div");
      rowDiv.className = "seat-row";

      const rowLabel = String.fromCharCode(65 + row); // A, B, C, D…

      // LEFT SIDE
      for (let i = 1; i <= left; i++) {
        if (currentSeatCount >= seatCapacity) break;
        createSeat(rowDiv, rowLabel + i);
        currentSeatCount++;
      }

      // AISLE
      const aisle = document.createElement("div");
      aisle.className = "aisle";
      rowDiv.appendChild(aisle);

      // RIGHT SIDE
      for (let i = 1; i <= right; i++) {
        if (currentSeatCount >= seatCapacity) break;
        createSeat(rowDiv, rowLabel + (left + i));
        currentSeatCount++;
      }

      seatContainer.appendChild(rowDiv);
    }
  }

  function createSeat(rowDiv, seatId) {
    const seat = document.createElement("div");
    seat.className = "seat";
    seat.textContent = seatId;

    seat.onclick = () => toggleSeat(seatId, seat);

    rowDiv.appendChild(seat);
  }

  function toggleSeat(id, el) {
    if (selectedSeats.includes(id)) {
      selectedSeats.splice(selectedSeats.indexOf(id), 1);
      el.classList.remove("selected");
    } else {
      selectedSeats.push(id);
      el.classList.add("selected");
    }
    updateSummary();
  }

  function updateSummary() {
    selectedSeatsDisplay.textContent = selectedSeats.length
      ? selectedSeats.join(", ")
      : "None";

    selectedSeatsInput.value = selectedSeats.join(", ");
    totalAmount.value = selectedSeats.length * seatPrice;
  }

  function playHorn() {
    const audio = new Audio("{{ asset('sound/horn.m4a') }}");
    audio.play();
  }

  document.addEventListener("DOMContentLoaded", generateDynamicSeats);
</script>


<script>
  // const rows = 10;
  // const cols = 4;
  // const seatPrice = {{ $schedule->price }};
  // const seatLayout = document.getElementById("seat-layout");
  // const selectedSeatsDisplay = document.getElementById("selected-seats");
  // const selectedSeatsInput = document.getElementById("selectedSeatsInput");
  // const totalAmount = document.getElementById("totalAmount");
  // let selectedSeats = [];

  // function generateSeats() {
  //   for (let i = 0; i < rows; i++) {
  //     const rowLabel = String.fromCharCode(65 + i);
  //     const rowDiv = document.createElement("div");
  //     rowDiv.className = "seat-row";
  //     for (let j = 1; j <= cols; j++) {
  //       if (j === 3) {
  //         const aisle = document.createElement("div");
  //         aisle.className = "aisle";
  //         rowDiv.appendChild(aisle);
  //       }
  //       const seat = document.createElement("div");
  //       seat.className = "seat";
  //       seat.textContent = `${rowLabel}${j}`;
  //       seat.onclick = () => toggleSeat(`${rowLabel}${j}`, seat);
  //       rowDiv.appendChild(seat);
  //     }
  //     seatLayout.appendChild(rowDiv);
  //   }
  // }

  // function toggleSeat(seatId, element) {
  //   if (selectedSeats.includes(seatId)) {
  //     selectedSeats = selectedSeats.filter(s => s !== seatId);
  //     element.classList.remove("selected");
  //   } else {
  //     selectedSeats.push(seatId);
  //     element.classList.add("selected");
  //   }
  //   updateSummary();
  // }

  // function updateSummary() {
  //   selectedSeatsDisplay.textContent = selectedSeats.length ? selectedSeats.join(", ") : "None";
  //   selectedSeatsInput.value = selectedSeats.join(", ");
  //   const total = selectedSeats.length * seatPrice;
  //   totalAmount.value =total;
  // }

  // function playHorn() {
  //   const audio = new Audio("{{ asset('sound/horn.m4a') }}");
  //   audio.play();
  // }

  // document.addEventListener("DOMContentLoaded", generateSeats);
</script>
@endsection