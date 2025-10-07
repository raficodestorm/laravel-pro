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

// const ctx = document.getElementById('salesChart');

//         new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 labels: [
//                     '28', '29', '30', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
//                     '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27'
//                 ],
//                 datasets: [{
//                     label: 'Total Sales',
//                     data: [
//                         102, 106, 109, 112, 114, 114, 118, 121, 122, 119, 114, 114, 109,
//                         107, 105, 102, 98, 97, 99, 103, 107, 107, 105, 106, 104, 100, 102, 98, 101, 101
//                     ],
//                     backgroundColor: 'rgba(52, 152, 219, 0.6)',
//                     borderRadius: 5,
//                     borderWidth: 1,
//                 }]
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: false,
//                         min: 95,
//                         max: 125,
//                         grid: {
//                             color: '#eee'
//                         },
//                         ticks: {
//                             stepSize: 5
//                         }
//                     },
//                     x: {
//                         grid: {
//                             display: false
//                         }
//                     }
//                 },
//                 plugins: {
//                     legend: { display: false },
//                     tooltip: {
//                         backgroundColor: '#2c3e50',
//                         titleColor: '#fff',
//                         bodyColor: '#fff'
//                     }
//                 }
//             }
//         });