@extends('layouts.userlayout')
@section('content')

<div class="card shadow border-0 rounded-4">
    <div class="card-header bg-primary text-white fw-bold">Add New Location</div>
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

        <form action="{{ route('locations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">District</label>
                <input type="text" name="district" class="form-control" placeholder="Enter district" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Division</label>
                <input type="text" name="division" class="form-control" placeholder="Enter division (optional)">
            </div>
            <button type="submit" class="btn btn-success px-4">Save</button>
            <a href="{{ route('locations.index') }}" class="btn btn-secondary px-4">Back</a>
        </form>
    </div>
</div>

@endsection
