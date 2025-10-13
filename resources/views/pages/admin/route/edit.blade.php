@extends('layouts.adminlayout')
@section('content')

<div class="container main-area">
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

            <form action="{{ route('routes.update', $route->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Route Code</label>
                    <input type="text" name="route_code" class="form-control" value="{{ $route->route_code }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Start location</label>
                    <input type="text" name="start_location" class="form-control" value="{{ $route->start_location }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">End location</label>
                    <input type="text" name="end_location" class="form-control" value="{{ $route->end_location }}">
                </div>

                <button type="submit" class="btn btn-success px-4">Update</button>
                <a href="{{ route('routes.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection