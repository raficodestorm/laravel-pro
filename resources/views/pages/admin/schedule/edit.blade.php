@extends('layouts.adminlayout')

@section('content')
<div class="container mt-5">
  <div class="card shadow p-4">
    <h3 class="mb-4 text-center text-danger">Edit Schedule</h3>

    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST" id="scheduleForm">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Date</label>
          <input type="date" name="set_date" class="form-control" required
            value="{{  old('set_date', $schedule->set_date) }}">
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Time</label>
          <input type="time" name="set_time" class="form-control" required
            value="{{  old('set_time', $schedule->set_time) }}">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Route Code</label>
          <input type="text" id="route_code" name="route_code" class="form-control" list="routeSuggestions"
            autocomplete="off" required value="{{  old('route_code', $schedule->route_code) }}">
          <datalist id="routeSuggestions"></datalist>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Price</label>
          <input type="number" name="price" step="0.01" class="form-control" required
            value="{{  old('price', $schedule->price) }}">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Start Location</label>
          <input type="text" name="start_location" id="start_location" class="form-control" readonly
            value="{{  old('start_location', $schedule->start_location) }}">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">End Location</label>
          <input type="text" name="end_location" id="end_location" class="form-control" readonly
            value="{{  old('end_location', $schedule->end_location) }}">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Distance</label>
          <input type="text" name="distance" id="distance" class="form-control" readonly
            value="{{  old('distance', $schedule->distance) }}">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Duration</label>
          <input type="text" name="duration" id="duration" class="form-control" readonly
            value="{{  old('duration', $schedule->duration) }}">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Bus Type</label>
          <select class="form-control" name="bus_type" id="bus_type">
            <option value="{{  old('bus_type', $schedule->bus_type) }}">{{ old('bus_type', $schedule->bus_type) }}
            </option>
            @foreach($bustypes as $type)
            <option value="{{$type->type}}">{{$type->type}}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Coach No</label>
          <input type="text" id="coach_no" name="coach_no" class="form-control" list="coachSuggestions"
            autocomplete="off" required value="{{  old('coach_no', $schedule->coach_no) }}">
          <datalist id="coachSuggestions"></datalist>
        </div>

        <div class="col-12 text-center mt-3">
          <button type="submit" class="btn btn-danger px-4">Update Schedule</button>
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