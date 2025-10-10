@extends('layouts.adminlayout')

@section('content')
<div class="container">
  <h2>Bus Detail</h2>
  <p><strong>Bus Name:</strong> {{ $bus->name }}</p>
  <p><strong>Coach No:</strong> {{ $bus->coach_no }}</p>
  <p><strong>License:</strong> {{ $bus->license }}</p>
  <p><strong>Company:</strong> {{ $bus->company }}</p>
  <p><strong>Route:</strong> {{ $bus->route }}</p>
  <p><strong>Route:</strong> {{ $bus->timestamps }}</p>

  <a href="{{ route('buses.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection