<nav class="sidebar">
  <ul>
    <li class="first">
      <span class="nav-logo">RunStar</span>
      <button class="toggle-btn" id="toggleSide" onclick="toggleSidebar()">
        <svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#220901">
          <path
            d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z" />
        </svg>
      </button>
    </li>
    <li>
      <a href="{{ route('pages.admin.admindashboard') }}" title="Dashboard">
        <i class="fa-solid fa-gauge"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="dropdown">
      <a href="#" onclick="toggleSubmenu(event)" title="Stations" id="drop">
      <i class="fa fa-calendar"></i>
        <span>Schedule</span>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
          fill="#0000F5">
          <path d="M480-360 280-560h400L480-360Z" />
        </svg>
      </a>
      <ul class="submenu">
        <div>
          <li class="{{request()->routeIs('schedules.create')?'active':''}}"><a href="{{ route('schedules.create') }}" title="Booking" id="sub">
              <i class="fa-regular fa-clock"></i>
              <span>Create shedule</span>
            </a>
          </li>
          <li><a href="#" title="Booking" id="sub">
              <i class="fa-solid fa-calendar-days"></i>
              <span>All schedules</span>
            </a>
          </li>
        </div>
      </ul>
    </li>


    <li>
      <a href="{{ route('buses.index') }}" title="Bus Entry">
        <i class="fa-solid fa-bus"></i>
        <span>Buses</span>
      </a>
    </li>
    <li>
      <a href="{{ route('locations.index') }}" title="Booking">
        <i class="fa-solid fa-bus"></i>
        <span>location</span>
      </a>
    </li>
    <li>
      <a href="{{ route('routes.index') }}" title="Booking">
        <i class="fa-solid fa-bus"></i>
        <span>Route</span>
      </a>
    </li>

    <li class="dropdown">
      <a href="#" onclick="toggleSubmenu(event)" title="Stations" id="drop">
        <i class="fa-solid fa-bus"></i>
        <span>Stations</span>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
          fill="#0000F5">
          <path d="M480-360 280-560h400L480-360Z" />
        </svg>
      </a>
      <ul class="submenu">
        <div>
          <li><a href="#" title="Booking" id="sub">
              <i class="fa-solid fa-bus"></i>
              <span>add</span>
            </a>
          </li>
          <li><a href="#" title="Booking" id="sub">
              <i class="fa-solid fa-bus"></i>
              <span>remove</span>
            </a>
          </li>
          <li><a href="#" title="Booking" id="sub">
              <i class="fa-solid fa-bus"></i>
              <span>edit</span>
            </a>
          </li>
          <li><a href="#" title="Booking" id="sub">
              <i class="fa-solid fa-bus"></i>
              <span>show</span>
            </a>
          </li>
        </div>
      </ul>
    </li>


    <li>
      <a href="#" title="Companies">
        <i class="fa-solid fa-bus"></i>
        <span>Companies</span>
      </a>
    </li>
    <li>
      <a href="#" title="Caleder">
        <i class="fa-solid fa-bus"></i>
        <span>Calender</span>
      </a>
    </li>
  </ul>
</nav>

<script>
  function toggleSubmenu(event) {
    event.preventDefault(); // stop link jump

    const dropdown = event.target.closest(".dropdown");
    const submenu = dropdown.querySelector(".submenu");
    const arrowDrop = dropdown.querySelector(".arrow");

    // Close all other open menus
    document.querySelectorAll(".submenu.showmenu").forEach(menu => {
        if (menu !== submenu) {
            menu.classList.remove("showmenu");
        }
    });

    // Toggle this one
    submenu.classList.toggle("showmenu");
    arrowDrop.classList.toggle("rotate");
}

// Close if clicked outside
document.addEventListener("click", function(e) {
    const isClickInside = e.target.closest(".dropdown");
    if (!isClickInside) {
        document.querySelectorAll(".submenu.showmenu").forEach(menu => {
            menu.classList.remove("showmenu");
        });
    }
});



const SideToggle = document.getElementById("toggleSide");
const sideBar = document.querySelector(".sidebar");

function toggleSidebar() {
    SideToggle.classList.toggle("rotate");
    sideBar.classList.toggle("close");

    document.querySelectorAll('#sub').forEach(sub => {
        if (sideBar.classList.contains('close')) {
            sub.classList.add('subpadding');
        } else {
            sub.classList.remove('subpadding');
        }
    });
}

</script>