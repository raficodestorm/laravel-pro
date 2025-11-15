@extends('layouts.userlayout')

@section('title', 'Home Page')

@section('content')


<div class="container-fluid master-background">
  <div class="row justify-content-between w-100">
    <div class="col-md-6">
      <div class="heading">
        <h1>RunStar is Near, <br />Start your journey Here,</h1>
        <p>Book fast, Ride easy and cheer!</p>
      </div>
    </div>
    <div class="col-md-4 p-5 form-part">
      <div class="light1"></div>
      <div class="light2"></div>



      {{-------------------------------- form ---------------------------------------------------------}}
      <div class="card shadow-sm p-4 rounded-3">
        <h5 class="fw-bold mb-3 text-center" style="color: #220901;">
          Find Your Bus
        </h5>
        <form action="{{ route('bus.search') }}" method="POST">
          @csrf
          {{-- {/* From */} --}}
          <div class="mb-3 form-in">
            <label class="form-label fw-semibold">From</label>
            <select name="from" class="form-control rounded-3" required>
              <option value="">-- Select Location --</option>

              @foreach($location as $loc)
              <option value="{{ $loc->district }}">
                {{ $loc->district }}
              </option>
              @endforeach

            </select>
          </div>

          {{-- {/* To */} --}}
          <div class="mb-3 form-in">
            <label class="form-label fw-semibold">To</label>
            <select name="to" class="form-control rounded-3" required>
              <option value="">-- Select Location --</option>

              @foreach($location as $loc)
              <option value="{{ $loc->district }}">
                {{ $loc->district }}
              </option>
              @endforeach

            </select>
          </div>

          {{-- {/* Date */} --}}
          <div class="mb-3 form-in">
            <label class="form-label fw-semibold">Date of Journey</label>
            <input type="date" name="date" class="form-control rounded-3" required>
          </div>

          {{-- {/* Button */} --}}
          <div class="d-grid ">
            <button type="submit" class="btn bus-src rounded-3 fw-semibold">
              Search Buses
            </button>
          </div>
        </form>
      </div>


    </div>
  </div>
</div>



{{-------------- popular route section --------------------------------}}
<div class="container my-5 p-routes">
  <h2 class="text-center mb-4 popular-title">Popular Routes</h2>
  <div class="row g-4">
    {{-- Route cards --}}
    @php
    $routes = [
    ['from' => 'Dhaka', 'to' => 'Natore'],
    ['from' => 'Natore', 'to' => 'Dhaka'],
    ['from' => 'Dhaka', 'to' => 'Rajshahi'],
    ['from' => 'Rajshahi', 'to' => 'Dhaka'],
    ['from' => 'Kustia', 'to' => 'Dhaka'],
    ['from' => 'Dhaka', 'to' => 'Kustia'],
    ['from' => 'Meherpur', 'to' => 'Dhaka'],
    ['from' => 'Dhaka', 'to' => 'Meherpur'],
    ['from' => "Dhaka", 'to' => "Cox's Bazar"],
    ];
    @endphp

    @foreach ($routes as $route)
    <div class="col-md-4 col-sm-6 card-route">
      <div class="main-card rounded-3 p-3">
        <div class="int">
          <span>From</span>
          <span>To</span>
        </div>
        <div class="route-card d-flex justify-content-between align-items-center">
          <span class="fw-bold">{{ $route['from'] }}</span>
          <div class="route-line mt-2 mb-2">
            <i class="bi bi-bus-front bus-icon"></i>
          </div>
          <span class="fw-bold">{{ $route['to'] }}</span>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>


{{-------------- All services section --------------------------------}}
<div class="container-fluid mt-3">
  <div class="col-12 text-center mb-2 ">
    <h1 class="fw-bold " style="font-family: 'El Messiri', sans-serif; color: var(--second-color);">
      Our Variations
    </h1>
  </div>

  {{-- First row --}}
  <div class="row g-3">
    <div class="col-md-6 p-5 service-col">
      <div class="service-card">
        <img class="img-fluid service-img" src="{{ asset('image/bus-6.png') }}" alt="Standard Non-AC">
      </div>
      <div class="service-ins">
        <h3>Standard Non-AC</h3>
        <p>Affordable travel with simple comfort.</p>
      </div>
    </div>

    <div class="col-md-6 p-5 service-col">
      <div class="service-card">
        <img class="img-fluid service-img" src="{{ asset('image/bus-7.png') }}" alt="AC Coach">
      </div>
      <div class="service-ins">
        <h3>AC Coach</h3>
        <p>Affordable travel with comfort.</p>
      </div>
    </div>
  </div>

  {{-- Second row --}}
  <div class="row g-3 mb-5">
    <div class="col-md-6 p-5 service-col">
      <div class="service-card">
        <img class="img-fluid service-img" src="{{ asset('image/bus-8.png') }}" alt="Luxurious">
      </div>
      <div class="service-ins">
        <h3>Luxurious</h3>
        <p>Affordable travel with super comfort.</p>
      </div>
    </div>

    <div class="col-md-6 p-5 service-col">
      <div class="service-card">
        <img class="img-fluid service-img" src="{{ asset('image/bus-10.png') }}" alt="Sleeper Coach">
      </div>
      <div class="service-ins">
        <h3>Sleeper Coach</h3>
        <p>Affordable travel with dreaming.</p>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  const fromInput = document.querySelector('input[name="from"]');
  const toInput = document.querySelector('input[name="to"]');
  const fromList = document.getElementById('fromList');
  const toList = document.getElementById('toList');

  function fetchLocations(query, datalist) {
    if (query.length < 1) return; // এক অক্ষর টাইপ না করলে রিকোয়েস্ট পাঠাবে না

    fetch(`/locations?q=${query}`)
      .then(res => res.json())
      .then(data => {
        datalist.innerHTML = ''; // পুরনো সাজেস্ট ক্লিয়ার
        data.forEach(location => {
          const option = document.createElement('option');
          option.value = location;
          datalist.appendChild(option);
        });
      });
  }

  fromInput.addEventListener('input', () => fetchLocations(fromInput.value, fromList));
  toInput.addEventListener('input', () => fetchLocations(toInput.value, toList));
});

</script>

@endsection