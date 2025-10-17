@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Edit Location</div>
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

            <form action="{{ route('locations.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">District</label>
                    <input type="text" name="district" class="form-control" value="{{ $location->district }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Division</label>
                    <input type="text" name="division" class="form-control" value="{{ $location->division }}">
                </div>

                <button type="submit" class="btn btn-success px-4">Update</button>
                <a href="{{ route('locations.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>

@endsection