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
      {{-- form --}}
      <div class="card shadow-sm p-4 rounded-3">
        <h5 class="fw-bold mb-3 text-center" style="color: #220901;">
          Find Your Bus
        </h5>
        <form onSubmit={handleSubmit}>
          {{-- {/* From */} --}}
          <div class="mb-3 form-in">
            <label class="form-label fw-semibold">From</label>
            <input type="text" name="from" class="form-control rounded-3" placeholder="Enter departure city..."
              value={searchData.from} onChange={handleChange} required />
          </div>

          {{-- {/* To */} --}}
          <div class="mb-3 form-in">
            <label class="form-label fw-semibold">To</label>
            <input type="text" name="to" class="form-control rounded-3" placeholder="Enter destination city..."
              value={searchData.to} onChange={handleChange} required />
          </div>

          {{-- {/* Date */} --}}
          <div class="mb-3 form-in">
            <label class="form-label fw-semibold">Date of Journey</label>
            <input type="date" name="date" class="form-control rounded-3" value={searchData.date}
              onChange={handleChange} required />
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
@endsection