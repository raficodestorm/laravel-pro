@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header text-white fw-bold p-2 mb-3" style="background-color: #ff0000">Add New Driver</div>
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

            <form action="{{ route('admin.drivers.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Full name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Father name</label>
                    <input type="text" name="father" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">License Number</label>
                    <input type="text" name="license" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="textaria" name="address" class="form-control" placeholder="Enter address">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Route</label>
                    <select name="route_id" class="form-control" required>
                        <option value="">-- Select Route --</option>

                        @foreach($routes as $route)
                        <option value="{{ $route->id }}">
                            {{ $route->route_code }}
                        </option>
                        @endforeach

                    </select>
                </div>


                <button type="submit" class="btn btn-success px-4">Save</button>
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection