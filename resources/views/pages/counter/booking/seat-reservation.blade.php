@extends('layouts.userlayout')

@section('content')
<style>
  /* ---------------------  style for seat Resrvation ------------------------------------ */
  .seat-reservation {
    margin-top: 35px;
    margin-bottom: 30px;
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(128, 128, 128, 0.854) !important;
  }

  .bus-container {
    width: 350px;
    margin: auto;
    margin-bottom: 20px;
    padding: 15px;
    border: 2px solid #ddd;
    border-radius: 10px;
    background: var(--bg-color);
  }

  .legend {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin: .5rem 0 1rem 0;
  }

  .legend .seat {
    text-align: center;
    line-height: 1rem;
    border-radius: 4px;
    font-size: 12px;
    cursor: default;
    height: 45px;
    width: 55px;
  }

  .seat.blocked {
    background: #333;
    color: white;
    border: .5px solid var(--main-color);
  }

  .seat.available {
    background: #fffffc;
    color: #333;
    border: .5px solid var(--main-color);
  }

  .seat.selected {
    background: #4CAF50;
    color: white;
    border: .5px solid var(--main-color);
  }

  /* green */
  .seat.soldM {
    background: #ff0000;
    color: white;
    border: .5px solid var(--main-color);
  }

  /* red */
  .seat.soldF {
    background: #ff2ecc;
    color: white;
    border: .5px solid var(--main-color);
  }

  /* pink */

  .bus-front {
    display: flex;
    justify-content: space-between;
    margin: 0 20px 20px 20px;
  }

  .driver {
    font-weight: bold;
    width: 60px;
    text-align: center;
  }

  .driver svg {
    font-size: 40px;
    animation: steering-spin 2s linear infinite, fill-change 3s ease-in-out infinite;
  }

  /* Spin animation */
  @keyframes steering-spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  /* Animate fill color */
  @keyframes fill-change {
    0% {
      fill: red;
    }

    25% {
      fill: blue;
    }

    50% {
      fill: #780116;
    }

    75% {
      fill: green;
    }

    100% {
      fill: red;
    }
  }

  .door {
    color: gray;
    font-weight: bold;
    padding: 10px;
    border-radius: 6px;
    width: 60px;
    text-align: center;
  }

  .deck {
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
  }

  .deck-title {
    text-align: center;
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 18px;
  }

  .seat {
    width: 35px;
    height: 35px;
    background: #eee;
    color: var(--second-color);
    border: 1.5px solid var(--main-color);
    margin: 3px;
    font-size: 12px;
    border-radius: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: 0.2s;
    font-weight: 500;
  }

  .seat.selected {
    background: #4caf50;
    color: white;
  }

  .double-deck-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .lower-deck {
    background: #f8f9fa;
    flex: 1;
    min-width: 300px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  }

  .upper-deck {
    background: #f8f9fa;
    flex: 1;
    min-width: 300px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .deck-divider {
    border: none;
    border-top: 2px dashed #aaa;
    margin: 20px 0;
  }

  @media (max-width: 768px) {
    .double-deck-container {
      flex-direction: column;
    }
  }

  .seats {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .seat-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
  }

  .seat:hover {
    transform: scale(1.05);
  }

  .aisle {
    width: 40px;
    /* space for walking */
  }

  .summary {
    margin-top: 20px;
    padding: 10px;
    border-top: 1px solid #ccc;
    text-align: center;
  }

  .reservation-form {
    margin-top: 4.4rem;
    margin-right: 4rem;
    margin-bottom: 1rem;
  }

  .reservation-form select,
  .reservation-form input {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 8px;
    border-radius: 5px;
    background-color: var(--bg-color);
    border: .5px solid var(--light-hover);
  }

  /* .reservation-form select, */
  input:focus {
    border: none;
  }

  .submit-btn {
    width: 100%;
    background: linear-gradient(90deg, #ff0000, #780116);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    animation: wiggle 1s ease-in-out infinite;
  }

  /* Wiggle animation */
  @keyframes wiggle {
    0% {
      transform: translateX(-3px);
      background: linear-gradient(90deg, #ff0000, #780116);
    }

    50% {
      transform: translateX(3px);
      background: linear-gradient(90deg, #780116, #ff0000);
    }

    100% {
      transform: translateX(-3px);
      background: linear-gradient(90deg, #ff0000, #780116);
    }
  }

  /* Apply on hover */
  .submit-btn:hover {
    box-shadow: 0 0 10px var(--main-color);
  }

  .inline {
    display: inline-block !important;
  }

  .hidein {
    border: none !important;
    display: inline-block !important;
    width: 50% !important;
    margin: 0 !important;
    padding: 0 !important;
  }
</style>
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
            <input class="hidein" type="text" id="departure" name="departure"
              value="{{ date('H:i', strtotime($schedule->set_time)) }}" readonly><br>

            <p class="inline"><strong>Boarding point:</strong></p>
            <select id="boarding" name="boarding" required>
              <option value="">Select boarding point</option>
              @foreach($boardingCounters as $boardcounter)
              <option value="{{ $boardcounter->name }}" data-distance="{{ $boardcounter->distance }}">
                {{ $boardcounter->name }}
              </option>
              @endforeach
            </select>

            <p class="inline"><strong>Dropping point:</strong></p>
            <select name="dropping" required>
              <option value="">Select dropping point</option>
              @foreach($droppingCounters as $dropcounter)
              <option value="{{ $dropcounter->name }}">
                {{ $dropcounter->name }}
              </option>
              @endforeach
            </select>
          </div>

          <h4>SEAT INFORMATION:</h4>
          <span>Selected Seats:</span>
          <input type="text" id="selectedSeatsInput" name="selected_seats" readonly>

          <span>Total amount:</span>
          <input type="text" id="totalAmount" name="total" readonly>

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
  const busType = "{{ $bustype }}".toLowerCase();
  const seatPrice = {{ $schedule->price }};
  const bookedSeats = @json($bookedSeats);

  const selectedSeats = [];
  const seatContainer = document.getElementById("seat-layout");
  const selectedSeatsDisplay = document.getElementById("selected-seats");
  const selectedSeatsInput = document.getElementById("selectedSeatsInput");
  const totalAmount = document.getElementById("totalAmount");

  document.addEventListener("DOMContentLoaded", () => {
    if (busType.includes("double-decker")) {
      generateDoubleDeckerSeats();
    } else {
      generateSingleDeckSeats();
    }
  });

  /** Generate seats for single-decker buses */
  function generateSingleDeckSeats() {
    const singleDeck = document.createElement("div");
    singleDeck.className = "deck single-deck";
    // singleDeck.innerHTML = `<h3 class="deck-title">Single Deck</h3>`;
    seatContainer.appendChild(singleDeck);

    generateSeats(singleDeck, seatLayout, seatCapacity, "A");
  }

  /** Generate seats for double-decker buses (two separate styled divs) */
  function generateDoubleDeckerSeats() {
    const container = document.createElement("div");
    container.className = "double-deck-container";
    seatContainer.appendChild(container);

    const halfCapacity = Math.ceil(seatCapacity / 2);

    // LOWER DECK
    const lowerDeck = document.createElement("div");
    lowerDeck.className = "deck lower-deck";
    lowerDeck.innerHTML = `<h3 class="deck-title">Lower Deck</h3>`;
    container.appendChild(lowerDeck);

    generateSeats(lowerDeck, seatLayout, halfCapacity, "A");

    // UPPER DECK
    const upperDeck = document.createElement("div");
    upperDeck.className = "deck upper-deck";
    upperDeck.innerHTML = `<h3 class="deck-title">Upper Deck</h3>`;
    container.appendChild(upperDeck);

    generateSeats(upperDeck, seatLayout, halfCapacity, "K");
  }

  /** Generate seats dynamically */
  function generateSeats(container, layout, capacity, startLetter = "A") {
    const [left, right] = layout.split(":").map(Number);
    const seatsPerRow = left + right;
    const totalRows = Math.ceil(capacity / seatsPerRow);
    let currentSeatCount = 0;

    for (let row = 0; row < totalRows; row++) {
      const rowDiv = document.createElement("div");
      rowDiv.className = "seat-row";

      const rowLetter = String.fromCharCode(startLetter.charCodeAt(0) + row);
      let seatNumber = 1;

      // LEFT side
      for (let i = 0; i < left && currentSeatCount < capacity; i++) {
        createSeat(rowDiv, `${rowLetter}${seatNumber++}`);
        currentSeatCount++;
      }

      // Aisle
      const aisle = document.createElement("div");
      aisle.className = "aisle";
      rowDiv.appendChild(aisle);

      // RIGHT side
      for (let i = 0; i < right && currentSeatCount < capacity; i++) {
        createSeat(rowDiv, `${rowLetter}${seatNumber++}`);
        currentSeatCount++;
      }

      container.appendChild(rowDiv);
    }
  }

  /** Create an individual seat */
  // function createSeat(rowDiv, seatId) {
  //   const seat = document.createElement("div");
  //   seat.className = "seat";
  //   seat.textContent = seatId;
  //   seat.onclick = () => toggleSeat(seatId, seat);
  //   rowDiv.appendChild(seat);
  // }

  function createSeat(rowDiv, seatId) {
    const seat = document.createElement("div");
    seat.className = "seat";
    seat.textContent = seatId;

    // ✅ If already booked → mark red and disable
    if (bookedSeats.includes(seatId)) {
        seat.classList.add("soldM");   // red color
        seat.style.pointerEvents = "none"; // disable clicking
    } else {
        seat.onclick = () => toggleSeat(seatId, seat);
    }

    rowDiv.appendChild(seat);
}


  /** Toggle seat selection */
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

  /** Update summary info */
  function updateSummary() {
    selectedSeatsDisplay.textContent = selectedSeats.length
      ? selectedSeats.join(", ")
      : "None";

    selectedSeatsInput.value = selectedSeats.join(", ");
    totalAmount.value = selectedSeats.length * seatPrice;
  }

  /** Optional horn sound */
  function playHorn() {
    const audio = new Audio("{{ asset('sound/horn.m4a') }}");
    audio.play();
  }




  //  departure time update
  document.addEventListener("DOMContentLoaded", () => {
  const boardingSelect = document.getElementById("boarding");
  const departureInput = document.getElementById("departure");
  
  // base departure from backend
  const baseDeparture = "{{ date('Y-m-d H:i', strtotime($schedule->set_time)) }}";

  boardingSelect.addEventListener("change", function () {
    const selectedOption = this.options[this.selectedIndex];
    const distance = parseInt(selectedOption.getAttribute("data-distance")) || 0;

    // convert base time to Date object
    const baseTime = new Date(baseDeparture);
    // add distance (in minutes)
    baseTime.setMinutes(baseTime.getMinutes() + distance);

    // format to hh:mm AM/PM
    const updatedTime = baseTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });

    departureInput.value = updatedTime;
  });
});
</script>


@endsection