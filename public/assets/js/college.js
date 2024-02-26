document.addEventListener("DOMContentLoaded", function() {
    var fullscreenButton = document.getElementById("fullscreenButton");
    var isFullscreen = false;

    fullscreenButton.addEventListener("click", function() {
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

            // Restaurar elementos ocultos
            // Aquí debes agregar el código para volver a mostrar los elementos ocultados, como la barra de navegación y el pie de página

            isFullscreen = false;
        }
    });
});
