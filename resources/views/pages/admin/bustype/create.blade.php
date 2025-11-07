@extends('layouts.adminlayout')
@section('content')

<div class="container-fluid main-area">
    <div class="index-card shadow">
        <div class="card-header text-white fw-bold p-2 mb-3" style="background-color: #ff0000">Add New BusType</div>
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

            <form action="{{ route('admin.bustypes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Type name</label>
                    <input type="text" name="type" class="form-control" placeholder="Enter bus type" required>
                </div>
                <button type="submit" class="btn btn-success px-4">Save</button>
                <a href="{{ route('admin.bustypes.index') }}" class="btn btn-secondary px-4">Back</a>
            </form>
        </div>
    </div>
</div>
@endsection