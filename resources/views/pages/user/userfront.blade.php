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
            <input type="text" name="from" class="form-control rounded-3" list="fromList" placeholder="Enter departure city..." required> 
            <datalist id="fromList"></datalist>
          </div>

          {{-- {/* To */} --}}
          <div class="mb-3 form-in">
            <label class="form-label fw-semibold">To</label>
            <input type="text" name="to" class="form-control rounded-3" list="toList" placeholder="Enter destination city..." required>
            
            <datalist id="toList"></datalist>
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


