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
        <img src="{{asset('svg/dashboard.svg')}}" alt="Dashboard" />
        <span>Dashboard</span>
      </a>
    </li>



    <li class="dropdown">
      <a href="#" onclick="toggleSubmenu(event)" title="Buses" id="drop">
        <img src="{{asset('svg/bus.svg')}}" />
        <span>Buses</span>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
          fill="#0000F5">
          <path d="M480-360 280-560h400L480-360Z" />
        </svg>
      </a>
      <ul class="submenu">
        <div>
          <li><a href="{{ route('buses.create') }}" title="Add New Bus" id="sub">
              <img src="{{asset('svg/addbus.svg')}}" />
              <span>Add New Bus</span>
            </a>
          </li>
          <li><a href="{{ route('buses.index') }}" title="All Buses" id="sub">
              <img src="{{asset('svg/list.svg')}}" />
              <span>All Buses</span>
            </a>
          </li>
        </div>
      </ul>
    </li>


    <li class="dropdown">
      <a href="#" onclick="toggleSubmenu(event)" title="Stations" id="drop">
        <img src="{{asset('svg/schedule.svg')}}" />
        <span>Schedule</span>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
          fill="#0000F5">
          <path d="M480-360 280-560h400L480-360Z" />
        </svg>
      </a>
      <ul class="submenu">
        <div>
          <li class="{{request()->routeIs('schedules.create')?'active':''}}"><a href="{{ route('schedules.create') }}"
              title="Booking" id="sub">
              <img src="{{asset('svg/addschedule.svg')}}" />
              <span>Create shedule</span>
            </a>
          </li>
          <li><a href="{{ route('schedules.index') }}" title="All schedules" id="sub">
              <img src="{{asset('svg/list.svg')}}" />
              <span>All schedules</span>
            </a>
          </li>
        </div>
      </ul>
    </li>

    <li class="dropdown">
      <a href="#" onclick="toggleSubmenu(event)" title="location" id="drop">
        <img src="{{asset('svg/location.svg')}}" />
        <span>location</span>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
          fill="#0000F5">
          <path d="M480-360 280-560h400L480-360Z" />
        </svg>
      </a>
      <ul class="submenu">
        <div>
          <li><a href="{{ route('locations.create') }}" title="Add location" id="sub">
              <img src="{{asset('svg/addlocation.svg')}}" />
              <span>Add location</span>
            </a>
          </li>
          <li><a href="{{ route('locations.index') }}" title="All locations" id="sub">
              <img src="{{asset('svg/list.svg')}}" />
              <span>All locations</span>
            </a>
          </li>
        </div>
      </ul>
    </li>



    <li class="dropdown">
      <a href="#" onclick="toggleSubmenu(event)" title="route" id="drop">
        <img src="{{asset('svg/route.svg')}}" />
        <span>Route</span>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
          fill="#0000F5">
          <path d="M480-360 280-560h400L480-360Z" />
        </svg>
      </a>
      <ul class="submenu">
        <div>
          <li><a href="{{ route('routes.create') }}" title="Add route" id="sub">
              <img src="{{asset('svg/addroute.svg')}}" />
              <span>Add Route</span>
            </a>
          </li>
          <li><a href="{{ route('routes.index') }}" title="All routes" id="sub">
              <img src="{{asset('svg/list.svg')}}" />
              <span>All Routes</span>
            </a>
          </li>
        </div>
      </ul>
    </li>


    <li class="dropdown">
      <a href="#" onclick="toggleSubmenu(event)" title="Stations" id="drop">
        <img src="{{asset('svg/list.svg')}}" />
        <span>Stations</span>
        <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
          fill="#0000F5">
          <path d="M480-360 280-560h400L480-360Z" />
        </svg>
      </a>
      <ul class="submenu">
        <div>
          <li><a href="#" title="Booking" id="sub">
              <img src="{{asset('svg/list.svg')}}" />
              <span>add</span>
            </a>
          </li>
          <li><a href="#" title="Booking" id="sub">
              <img src="{{asset('svg/list.svg')}}" />
              <span>remove</span>
            </a>
          </li>
        </div>
      </ul>
    </li>


    <li>
      <a href="#" title="Companies">
        <img src="{{asset('svg/addbus.svg')}}" />
        <span>Companies</span>
      </a>
    </li>

    <li>
      <a href="#" title="Caleder">
        <img src="{{asset('svg/schedule.svg')}}" />
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
        document.querySelectorAll(".arrow").forEach(menu => {
            menu.classList.remove("rotate");
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