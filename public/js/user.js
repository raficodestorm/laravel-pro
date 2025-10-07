// --------------------- script for navbar-----------------------------
document.querySelectorAll('.dropdown-submenu > a').forEach((element) => {
      element.addEventListener('click', (e) => {
        if (window.innerWidth < 992) {
          e.preventDefault();
          const submenu = element.nextElementSibling;
          submenu.classList.toggle('show');
        }
      });
    });


    // --------------------- script for navbar-----------------------------