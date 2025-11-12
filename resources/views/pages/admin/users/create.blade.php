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



  .auth-card {
    background-color: var(--bg-color);
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.2);
    padding: 2.5rem 3rem;
    max-width: 550px;
    width: 100%;
    margin: auto;
    border: 1px solid rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    animation: fadeInUp 0.8s ease;
  }

  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  h2 {
    text-align: center;
    color: var(--main-color);
    font-weight: 700;
    margin-bottom: 2rem;
    font-size: 1.8rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
  }

  .adduser-form {
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
  }

  .adduser-form>div {
    display: flex;
    flex-direction: column;
  }

  label {
    color: var(--text-color);
    font-weight: 500;
    margin-bottom: 0.3rem;
    font-size: 0.95rem;
  }

  .input-user {
    width: 100%;
    padding: 0.8rem 1rem;
    background-color: var(--back-color);
    color: var(--text-color);
    border: 1px solid var(--main-color);
    border-radius: 10px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
  }

  .input-user:focus {
    border-color: var(--main-color);
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.4);
    outline: none;
  }

  select option {
    background-color: #1a0f0a;
    color: #fff;
  }

  textarea {
    min-height: 90px;
    resize: vertical;
  }

  input[type="file"] {
    border: 1.5px dashed var(--second-color);
    padding: 0.5rem;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.05);
  }

  input[type="file"]::file-selector-button {
    background: var(--main-color);
    color: #fff;
    border: none;
    padding: 0.4rem 0.9rem;
    border-radius: 6px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  input[type="file"]::file-selector-button:hover {
    background: var(--light-hover);
    color: #1a0f0a;
  }

  .error-text {
    color: #ff5b5b;
    font-size: 0.85rem;
    margin-top: 0.3rem;
  }

  .btn-adduser {
    background: linear-gradient(90deg, var(--main-color), var(--second-color));
    color: #fff;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    padding: 0.9rem;
    margin-top: 0.8rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(255, 0, 0, 0.3);
  }

  .btn-adduser:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(255, 0, 0, 0.5);
    background: linear-gradient(90deg, var(--light-hover), var(--second-color));
  }


  @media (max-width: 576px) {
    .auth-card {
      padding: 2rem 1.5rem;
    }

    form {
      gap: 1rem;
    }
  }
</style>

<div class="container adduser-container justify-center">
  <div class="auth-card">
    <h2>Add Users</h2>

    <form class="adduser-form" method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
      @csrf

      <div>
        <label>Fullname</label>
        <input class="input-user" name="fullname" required>
        @error('fullname')<div class="error-text">{{ $message }}</div>@enderror
      </div>

      <div>
        <label>Username</label>
        <input class="input-user" name="username" required>
        @error('username')<div class="error-text">{{ $message }}</div>@enderror
      </div>

      <div>
        <label>Email</label>
        <input class="input-user" name="email" type="email" required>
        @error('email')<div class="error-text">{{ $message }}</div>@enderror
      </div>

      <div>
        <label>Password</label>
        <input class="input-user" type="password" name="password" required>
        @error('password')<div class="error-text">{{ $message }}</div>@enderror
      </div>

      <div>
        <label>Confirm Password</label>
        <input class="input-user" type="password" name="password_confirmation" required>
      </div>

      <div>
        <label>Role</label>
        <select class="input-user" name="role" required>
          <option value="controller">controller</option>
          <option value="counter_manager">Counter Manager</option>
          <option value="admin">Admin</option>
        </select>
        @error('role')<div class="error-text">{{ $message }}</div>@enderror
      </div>

      <div>
        <label>Father Name</label>
        <input class="input-user" name="father_name" required>
      </div>

      <div>
        <label>Phone</label>
        <input class="input-user" name="phone" required>
      </div>

      <div>
        <label>Address</label>
        <textarea class="input-user" name="address" required></textarea>
      </div>

      <div>
        <label>NID No</label>
        <input class="input-user" name="nid_no" required>
      </div>

      <div>
        <label for="">Counter</label>
        <select class="input-user" name="counter_id">
          <option value="">--select counter--</option>
          @foreach($counters as $counter)
          <option value="{{$counter->id}}">{{$counter->name}}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label>Profile Picture</label>
        <input class="input-user" type="file" name="profile_photo">
      </div>

      <div>
        <button class="btn-adduser" type="submit">Create</button>
      </div>
    </form>
  </div>
</div>
@endsection