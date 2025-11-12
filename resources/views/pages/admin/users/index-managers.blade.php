@extends('layouts.adminlayout')

@section('content')
<div class="container-fluid main-area">
  <div class="index-card">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-center">All Manageres</h2>
      <a href="{{route('admin.users.create')}}" class="btn btn-info">Add New manager</a>
    </div>

    <table class="table table-bordered table-hover" id="table-same">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Username</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Counter</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
          <td>{{ $user->id }}</td>
          <td>{{ $user->fullname }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone }}</td>
          <td>{{ $user->counter->name ?? " " }}</td>
          <td>
            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Image" width="60" height="60"
              style="object-fit: cover; border-radius: 8px;">
          </td>

          <td>
            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">View</a>
            <a href="{{ route('profile.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
              onsubmit="return confirm('Are you sure you want to delete this bus?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center text-muted">No records found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <div class="d-flex justify-content-center">

    </div>
  </div>
</div>
@endsection