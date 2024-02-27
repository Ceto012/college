document.addEventListener("DOMContentLoaded", function () {
    var fullscreenButton = document.getElementById("fullscreenButton");
    var isFullscreen = false;

    // Verificar si el botón de pantalla completa existe antes de agregar el event listener
    if (fullscreenButton) {
        fullscreenButton.addEventListener("click", function () {
            if (!isFullscreen) {
                // Ocultar y eliminar elementos del DOM
                var navbar = document.querySelector('.navbar');
                if (navbar) {
                    navbar.style.display = 'none';
                }

                var footer = document.querySelector('.footer');
                if (footer) {
                    footer.style.display = 'none';
                }

                var navbarBlur = document.querySelector('.navbar.navbar-main.navbar-expand-lg.px-0.mx-4.shadow-none.border-radius-xl');
                if (navbarBlur) {
                    navbarBlur.style.display = 'none';
                }

                var mainContent = document.querySelector('.main-content');
                if (mainContent) {
                    mainContent.style.marginLeft = '0'; // Ajusta el valor según tus necesidades
                }

                var mainContent = document.getElementById('mainContent');
                if (mainContent) {
                    mainContent.style.width = '100%';
                    mainContent.style.marginLeft = '0';
                    mainContent.style.paddingLeft = '0';
                }

                // Activar el modo de pantalla completa
                var elem = document.documentElement;
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                }

                isFullscreen = true;
            } else {
                // Salir del modo de pantalla completa
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }

                var navbar = document.querySelector('.navbar');
                if (navbar) {
                    navbar.style.display = 'block';
                }

                var footer = document.querySelector('.footer');
                if (footer) {
                    footer.style.display = 'block';
                }

                var navbarBlur = document.querySelector('.navbar.navbar-main.navbar-expand-lg.px-0.mx-4.shadow-none.border-radius-xl');
                if (navbarBlur) {
                    navbarBlur.style.display = 'block';
                }

                var mainContent = document.querySelector('.main-content');
                if (mainContent) {
                    mainContent.style.marginLeft = '17.125rem'; // Ajusta el valor según tus necesidades
                }
                isFullscreen = false;
            }
        });
    }
});

function toggleFullscreen() {
    var icon = document.getElementById("fullscreenIcon");
    if (icon.getAttribute("viewBox") === "0 0 384 512") {
        // Cambiar a ícono de pantalla completa
        icon.setAttribute("viewBox", "0 0 448 512");
        icon.innerHTML = '<path d="M436 192H312c-13.3 0-24-10.7-24-24V44c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v84h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-276-24V44c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v84H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24zm0 300V344c0-13.3-10.7-24-24-24H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-84h84c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12H312c-13.3 0-24 10.7-24 24v124c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12z"/>';
    } else {
        // Cambiar al otro ícono
        icon.setAttribute("viewBox", "0 0 448 512");
        icon.innerHTML = '<path d="M436 192H312c-13.3 0-24-10.7-24-24V44c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v84h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-276-24V44c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v84H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24zm0 300V344c0-13.3-10.7-24-24-24H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-84h84c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12H312c-13.3 0-24 10.7-24 24v124c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12z"/>';
    }
}

