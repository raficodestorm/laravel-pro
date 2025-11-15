<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('main.portal') }}">
      <span>RunStar</span>
    </a>
    <button class="navbar-toggler text-light border-0" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-lg-center">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Book Ticket</a></li>

        <!-- ✅ Dropdown with Submenu -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="servicesMenu" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Services
          </a>
          <ul class="dropdown-menu" aria-labelledby="servicesMenu">
            <li><a class="dropdown-item" href="#">Bus Routes</a></li>
            <li><a class="dropdown-item" href="#">Offers</a></li>
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-toggle" href="#">Support</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Contact Us</a></li>
                <li><a class="dropdown-item" href="#">FAQ</a></li>
                <li><a class="dropdown-item" href="#">Live Chat</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="#">My Bookings</a></li>

        <!-- ✅ User Dropdown -->
        @auth
        <li class="nav-item dropdown user-dropdown ms-lg-3">
          <a class="dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img style="border-radius: 50%; border: 1px solid gray;"
              src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="User">
            {{ auth()->user()->fullname }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li><a class="dropdown-item" href="#">My Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('dashboards') }}">Dashboard</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item text-danger">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @endauth

        @guest
        <li class="nav-item dropdown user-dropdown ms-lg-3">
          <a class="dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img style="border-radius: 50%; border: 1px solid gray;" src="{{asset('svg/user.svg')}}" alt="">User
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li><a class="dropdown-item" href="{{ route('register') }}">Registration</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <!-- <a class="dropdown-item text-danger" href="{{ route('login') }}">Login</a> -->
              <a href="javascript:void(0)" onclick="openLogin()">Login</a>
          </li>
          </ul>
        </li>
        @endguest

      </ul>
    </div>
  </div>
</nav>