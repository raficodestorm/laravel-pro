@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Edit Counter</div>
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

            <form action="{{ route('admin.counters.update', $counter->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Counter name</label>
                    <input type="text" name="name" class="form-control" value="{{ $counter->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Manager name</label>
                    <input type="text" name="manager" class="form-control" value="{{ $counter->manager }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Select District</label>
                    <select name="location_id" class="form-control" required>
                        <option value="">-- Select District --</option>

                        @foreach($locations as $loc)
                        <option value="{{ $loc->id }}" {{ $counter->location_id == $loc->id ? 'selected' : '' }}>
                            {{ $loc->district }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Distance</label>
                    <input type="text" name="distance" class="form-control" value="{{ $counter->distance }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $counter->address }}">
                </div>

                <button type="submit" class="btn btn-success px-4">Update</button>
                <a href="{{ route('admin.counters.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection