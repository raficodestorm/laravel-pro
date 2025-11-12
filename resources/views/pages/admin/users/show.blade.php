@extends('layouts.adminlayout')

@section('content')
<style>
  :root {
    --main-color: #ff0000;
    --second-color: #780116;
    --bg-color: #fffffc;
    --back-color: #edf6f9af;
    --text-color: #220901;
    --light-hover: #ff0101ca;
  }

  .user-frame {
    background: var(--bg-color);
    max-width: 800px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 2px solid var(--second-color);
  }

  .user-header {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-bottom: 25px;
  }

  .user-header img {
    width: 120px;
    height: 120px;
    border-radius: 12px;
    object-fit: cover;
    border: 3px solid var(--main-color);
  }

  .user-title h2 {
    margin: 0;
    color: var(--second-color);
    font-weight: 800;
  }

  .user-info {
    background: var(--back-color);
    padding: 20px 25px;
    border-radius: 12px;
    border-left: 4px solid var(--main-color);
  }

  .user-info p {
    font-size: 1rem;
    margin: 8px 0;
    color: var(--text-color);
  }

  .back-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: var(--main-color);
    color: white;
    border-radius: 8px;
    text-decoration: none;
    transition: .3s;
  }

  .back-btn:hover {
    background: var(--light-hover);
  }
</style>

<div class="user-frame">

  <div class="user-header">
    @if($user->profile_photo_path)
    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="User Photo">
    @else
    <img src="https://via.placeholder.com/120" alt="No Image">
    @endif

    <div class="user-title">
      <h2>{{ $user->fullname }}</h2>
      <small style="color: var(--text-color);">Username: {{ $user->username }}</small>
    </div>
  </div>

  <div class="user-info">
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone }}</p>
    <p><strong>Father's Name:</strong> {{ $user->father_name }}</p>
    <p><strong>Address:</strong> {{ $user->address }}</p>
    <p><strong>NID No:</strong> {{ $user->nid_no }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>
    <p><strong>Counter:</strong> {{ $user->counter->name ?? " " }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at }}</p>
  </div>

  <a href="{{ route('dashboard.admin') }}" class="back-btn">← Back</a>
</div>

@endsection