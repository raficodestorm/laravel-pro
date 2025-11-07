@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header text-white fw-bold p-2 mb-3" style="background-color: #ff0000">Add New Counter</div>
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

            <form action="{{ route('admin.counters.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Counter name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter location" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Manager name</label>
                    <input type="text" name="manager" class="form-control" placeholder="Enter manager name">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Select District</label>
                    <select name="location_id" class="form-control" required>
                        <option value="">-- Select District --</option>

                        @foreach($locations as $loc)
                        <option value="{{ $loc->id }}">
                            {{ $loc->district }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Distance</label>
                    <input type="text" name="distance" class="form-control" placeholder="Enter distance">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="textaria" name="address" class="form-control" placeholder="Enter address">
                </div>
                <button type="submit" class="btn btn-success px-4">Save</button>
                <a href="{{ route('admin.counters.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection