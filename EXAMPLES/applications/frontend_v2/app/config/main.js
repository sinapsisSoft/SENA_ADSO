function resizeIframe(iframe) {
    iframe.id = 'view-iframe';
    iframe.style.width = '100%';
    iframe.style.height = '100vh';
    iframe.style.border = 'none';
    iframe.style.overflow = 'hidden';
    iframe.style.border = 'none';
    iframe.style.display = 'block';
    iframe.style.margin = '0';
    iframe.style.padding = '0';
}
function loadingHeader(id, data = null) {
    const header = document.getElementById(id);
    header.innerHTML = `
    <header class="app-header navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <!-- Botón hamburguesa -->
            <button class="navbar-toggler " id="sidebar-toggle" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Título/Brand -->
            <a class="navbar-brand ms-3" href="#">Mi Aplicación</a>
            <!-- Menú usuario -->
            <div class="dropdown ms-auto">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>Usuario <i class="bi bi-person-circle" width="32" height="32" class=""></i></strong></i> 
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#appModal">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Configuración</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" onclick="logout()">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </header>
    `;
    fadeInElement(header);
}

function loadingFooter(id, data = null) {
    const footer = document.getElementById(id);
    footer.innerHTML = ` <footer class="app-footer py-3 bg-light border-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-muted">&copy; 2023 Mi Aplicación. Todos los derechos reservados.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-decoration-none me-2">Términos</a>
                    <a href="#" class="text-decoration-none me-2">Privacidad</a>
                    <a href="#" class="text-decoration-none">Ayuda</a>
                </div>
            </div>
        </div>
    </footer>`;
    fadeInElement(footer);
}

function loadingSidebar(id, data = null) {
    const sidebar = document.getElementById(id);
    sidebar.innerHTML = `
    <aside class="app-sidebar bg-light">
    <div class="sidebar-menu p-3">
        <ul class="nav flex-column" id="nav-role">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-collection"></i> Perfil App
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Admin</a></li>
                    <li><a class="dropdown-item" href="#">Client</a></li>
                </ul>
            </li>
        </ul>
        <hr>
        <ul class="nav flex-column" id="nav-pages" >
            

        </ul>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-gear"></i> Configuración
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-collection"></i> Más opciones
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Reportes</a></li>
                    <li><a class="dropdown-item" href="#">Estadísticas</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Ayuda</a></li>
                </ul>
            </li>
        </ul>
        <hr>
        <div class="px-3 py-2">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                <label class="form-check-label" for="darkModeSwitch">Modo oscuro</label>
            </div>
        </div>
    </div>
</aside>
     `;
    fadeInElement(sidebar);


}

function fadeOut(element, duration) {
    let opacity = 1;
    const interval = 10; // Adjust interval to control speed
    const steps = duration / interval;
    let currentStep = 0;

    const fadeInterval = setInterval(() => {
        if (currentStep >= steps) {
            clearInterval(fadeInterval);
            element.style.display = 'none';
        } else {
            opacity -= 1 / steps;
            element.style.opacity = opacity;
            currentStep++;
        }
    }, interval);
}

function fadeInElement(element) {

    element.style.display = "block";
    var opacity = 0;
    var interval = setInterval(function () {
        opacity += 0.1;
        element.style.opacity = opacity;
        if (opacity >= 1) {
            clearInterval(interval);
        }
    }, 50); // Adjust the interval for speed
}

function logout() {
    const storage = new AppStorage();
    if (confirm("Are you sure you want to logout?") == true) {
        storage.removeItem(KEY_TOKEN);
        storage.removeItem(PRIMARY_KEY);
        window.location.href = "../#auth";
    }
}

async function checkAuth() {
    toggleLoading(true);

    const storage = new AppStorage();
    const getToken = storage.getItem(KEY_TOKEN);
    const moduleLogin = "#auth";
    const moduleDashboard = "/#dashboard";
    const getUrl = window.location.href;

    if (!getToken) {
        //console.log("No token found, redirecting to login page.");
        // No token found, redirecting to login page.

        if (!getUrl.includes(moduleLogin)) {
            
            window.location.href = `../`
        }
        toggleLoading(false);
        return false;
    }

    try {
        // Verify the token with the server
        let endpointUrl = HOST + "/validate-token/";
        const response = getServicesAuth("", "POST", endpointUrl, getToken);
        response.then(response => {
            return response.json();
        }).then(data => {

            //console.log(data['data'].id);
            if (data['valid']) {
                // Token is valid, redirect to dashboard if not already there
                if (getUrl.includes(moduleLogin)) {
                    window.history.back();
                    window.history.forward();
                }
            } else {
                // Token is invalid, redirect to login page
                storage.removeItem(KEY_TOKEN);
                window.location.href = `..${moduleLogin}`;
                return false;
            }
        }).catch(error => {
            console.log(error);
        }).finally(() => {
            //console.log("finally");
            toggleLoading(false);
        });
    } catch (error) {
        console.error('Error al validate token:', error);
        storage.removeItem(KEY_TOKEN);
        //window.location.href = `..${moduleLogin}`;
        return false;
    }
}


// Function to show/hide the loader
function toggleLoading(show) {
    const loadingScreen = document.getElementById('loading-screen');
    loadingScreen.style.display = show ? 'flex' : 'none';
}

