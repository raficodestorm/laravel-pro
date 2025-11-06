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
                    <label class="form-label fw-semibold">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ $counter->location }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Manager name</label>
                    <input type="text" name="manager" class="form-control" value="{{ $counter->manager }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">District id</label>
                    <input type="text" name="district_id" class="form-control" value="{{ $counter->district_id }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Distance</label>
                    <input type="text" name="distance" class="form-control" value="{{ $counter->distance }}">
                </div>

                <button type="submit" class="btn btn-success px-4">Update</button>
                <a href="{{ route('admin.counters.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection