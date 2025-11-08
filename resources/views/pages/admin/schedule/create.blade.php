@extends('layouts.adminlayout')

@section('content')
<div class="container mt-5">
  <div class="card shadow p-4">
    <h3 class="mb-4 text-center text-danger">Create Schedule</h3>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('admin.schedules.store') }}" method="POST" id="scheduleForm">
      @csrf
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Date</label>
          <input type="date" name="set_date" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Time</label>
          <input type="time" name="set_time" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Route Code</label>
          <select class="form-control" name="route_code" id="route_code">
            <option value="">--select route--</option>
            @foreach($routes as $route)
            <option value="{{$route->route_code}}">{{$route->route_code}}</option>
            @endforeach
          </select>

        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Price</label>
          <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Start Location</label>
          <input type="text" name="start_location" id="start_location" class="form-control" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">End Location</label>
          <input type="text" name="end_location" id="end_location" class="form-control" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Distance</label>
          <input type="text" name="distance" id="distance" class="form-control" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Duration</label>
          <input type="text" name="duration" id="duration" class="form-control" readonly>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Bus Type</label>
          <select class="form-control" name="bus_type" id="bus_type">
            <option value="">--select bus type--</option>
            @foreach($bustypes as $type)
            <option value="{{$type->type}}">{{$type->type}}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Coach No</label>
          <input type="text" id="coach_no" name="coach_no" class="form-control" list="coachSuggestions"
            autocomplete="off" required>
          <datalist id="coachSuggestions"></datalist>
        </div>

        <div class="col-12 text-center mt-3">
          <button type="submit" class="btn btn-danger px-4">Save Schedule</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- jQuery for dynamic behavior --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {

    // Load all route codes for suggestions
    $.ajax({
        url: "{{ route('admin.get.route.info') }}",
        method: 'GET',
        success: function(response) {
            // We'll skip this because it expects a specific route_code input
        }
    });

    // When user types route_code
    $('#route_code').on('input', function() {
        let code = $(this).val();

        if(code.length > 0) {
            $.ajax({
                url: "{{ route('admin.get.route.info') }}",
                method: 'GET',
                data: { route_code: code },
                success: function(route) {
                    if(route) {
                        $('#start_location').val(route.start_location);
                        $('#end_location').val(route.end_location);
                        $('#distance').val(route.distance);
                        $('#duration').val(route.duration);
                    }
                }
            });
        }
    });

    // When bus_type changes, suggest coach numbers
    $('#bus_type').on('input', function() {
        let busType = $(this).val();

        if(busType.length > 0) {
            $.ajax({
                url: "{{ route('admin.get.coaches') }}",
                method: 'GET',
                data: { bus_type: busType },
                success: function(coaches) {
                    let dataList = $('#coachSuggestions');
                    dataList.empty();
                    coaches.forEach(function(coach){
                        dataList.append(`<option value="${coach}">`);
                    });
                }
            });
        }
    });

});
</script>
@endsection