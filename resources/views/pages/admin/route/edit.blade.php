@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Edit Route</div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.routes.update', $route->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Route Code</label>
                    <input type="text" name="route_code" class="form-control" value="{{ $route->route_code }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Start location</label>
                    <select class="form-control" name="start_location" id="start_location">
                        <option value="{{ $route->start_location }}">{{ $route->start_location }}</option>
                        @foreach($locations as $location)
                        <option value="{{$location->district}}">{{$location->district}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">End location</label>
                    <select class="form-control" name="end_location" id="end_location">
                        <option value="{{ $route->end_location }}">{{ $route->end_location }}</option>
                        @foreach($locations as $location)
                        <option value="{{$location->district}}">{{$location->district}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Distance</label>
                    <input type="text" name="distance" class="form-control" placeholder="distance"
                        value="{{ $route->distance }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Duration</label>
                    <input type="text" name="duration" class="form-control" placeholder="duration"
                        value="{{ $route->duration }}" required>
                </div>

                <button type="submit" class="btn btn-success px-4">Update</button>
                <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection