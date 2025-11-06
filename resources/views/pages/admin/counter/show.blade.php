@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header p-2 mb-3 text-white fw-bold" style="background-color: #ff0000">Counter Details</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $counter->id }}</p>
            <p><strong>Location:</strong> {{ $countr->location }}</p>
            <p><strong>Manager:</strong> {{ $counter->manager }}</p>
            <p><strong>District id:</strong> {{ $location->district }}</p>
            <p><strong>Distance:</strong> {{ $counter->distance }}</p>
            <p><strong>Created at:</strong> {{ $counter->manager }} </p>

            <a href="{{ route('admin.counters.index') }}" class="btn btn-secondary mt-3 px-4">Back</a>
        </div>
    </div>
</div>

@endsection