@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Edit Supervisor</div>
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

            <form action="{{ route('admin.supervisors.update', $superviser->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Full name</label>
                    <input type="text" name="name" class="form-control" value="{{ $superviser->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Father name</label>
                    <input type="text" name="father" class="form-control" value="{{ $superviser->father }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $superviser->phone }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="textaria" name="address" class="form-control" placeholder="Enter address"
                        value="{{ $superviser->address }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Route</label>
                    <select name="route_id" class="form-control" required>
                        <option value="{{ $superviser->route_id }}">{{ $superviser->route_id }}</option>

                        @foreach($routes as $route)
                        <option value="{{ $route->id }}">
                            {{ $route->route_code }}
                        </option>
                        @endforeach

                    </select>
                </div>


                <button type="submit" class="btn btn-success px-4">Update</button>
                <a href="{{ route('admin.supervisors.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection