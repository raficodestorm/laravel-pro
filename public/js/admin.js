// ==========this script for dropdown submenu=========================
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


//  -------------------------------- for sale chart --------------------------------

const ctx = document.getElementById("monthlyChart").getContext("2d");

      const data = {
        labels: [
          "Jan", "Feb", "Mar", "Apr", "May", "Jun",
          "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ],
        datasets: [
          {
            label: "Bookings",
            data: [120, 95, 110, 130, 125, 140, 100, 115, 90, 105, 98, 150],
            backgroundColor: "#ff0000",
            borderRadius: 6,
          },
        ],
      };

      const config = {
        type: "bar",
        data: data,
        options: {
          responsive: true,
          scales: {
            x: { grid: { display: false } },
            y: { beginAtZero: true },
          },
          plugins: {
            tooltip: { enabled: true },
            legend: { display: false },
          },
        },
      };

      new Chart(ctx, config);