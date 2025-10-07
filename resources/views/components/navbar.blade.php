  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        Bus<span>Hub</span>
      </a>
      <button class="navbar-toggler text-light border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav align-items-lg-center">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Book Ticket</a></li>

          <!-- ✅ Dropdown with Submenu -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="servicesMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
          <li class="nav-item dropdown user-dropdown ms-lg-3">
            <a class="dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://i.pravatar.cc/100?img=12" alt="User"> S A Rafi
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
              <li><a class="dropdown-item" href="#">My Profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>