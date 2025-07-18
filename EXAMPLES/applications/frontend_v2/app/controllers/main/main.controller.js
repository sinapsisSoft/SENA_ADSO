window.addEventListener('DOMContentLoaded', async () => {
  const main = document.getElementById('main');
  document.querySelector('body').style.display = 'none';
  document.querySelector('body').style.opacity = 0;


  await checkAuth();

  loadingFooter('footer');
  loadingSidebar('sidebar');
  loadingHeader('header');
  fadeInElement(document.querySelector('body'), 1000);
  getRolesUser();

  // Variables
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const navRole = document.getElementById('nav-role');

  //console.log(sidebarToggle);
  const body = document.body;

  // Toggle sidebar in desktop
  sidebarToggle.addEventListener('click', function () {
    if (window.innerWidth > 768) {
      body.classList.toggle('sidebar-collapsed');
    } else {
      body.classList.toggle('sidebar-show');
    }
  });
  // Close sidebar when clicking outside on mobile
  document.addEventListener('click', function (e) {
    if (window.innerWidth <= 768 &&
      !e.target.closest('.app-sidebar') &&
      !e.target.closest('.sidebar-toggle') &&
      body.classList.contains('sidebar-show')) {
      body.classList.remove('sidebar-show');
    }
  });
  // Dark mode toggle
  const darkModeSwitch = document.getElementById('darkModeSwitch');
  darkModeSwitch.addEventListener('change', function () {
    if (this.checked) {
      body.classList.add('dark-mode');
      // AHere you could save the preference in localStorage
    } else {
      body.classList.remove('dark-mode');
    }
  });

  async function getRolesUser() {
    toggleLoading(true);

    const storage = new AppStorage();
    const getUserID = storage.getItem(PRIMARY_KEY);
    
    if (!getUserID) {
      toggleLoading(false);
      return false;
    }
    try {
      // Verify the token with the server
      let endpointUrl = URL_USER_ID_ROLE + getUserID;
      const response = getDataServices("", "GET", endpointUrl);
      response.then(response => {
        return response.json();
      }).then(data => {

        createSelectRoles(data);
      });

    } catch (error) {
      console.error('Error al validate token:', error);

      return false;
    }
  }



  function createSelectRoles(data) {
    navRole.innerHTML = "";
    //console.log(data)
    let getRolesUser = data['data'];
    let rolelong = getRolesUser.length;
    if (rolelong == 1) {
      //create Menu role
    } else if (rolelong > 1) {
      let contentNav = `<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-collection"></i> Perfil App
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">`;
      for (let i = 0; i < rolelong; i++) {
        contentNav += `<li class=""><a class="dropdown-item text-capitalize" href="#" onclick="getRoleUser(${getRolesUser[i].role_id},${getRolesUser[i].user_id})" >${getRolesUser[i].role_name}</a></li>`;
      }
      contentNav += `
                </ul>
            </li>`;
      //console.log(contentNav)
      navRole.innerHTML = contentNav;

    } else {

    }
  }


});
function getRoleUser(idRole, idUser) {
  let documentData = {
    "user_id": idUser,
    "route_id": idRole
  };
  const resultServices = getDataServices(documentData, METHODS[1], URL_MODULE_USER_ROLE);
  resultServices.then(response => {
    return response.json();
  }).then(data => {
    //console.log(data);
    createNavModules(data);
  }).catch(error => {
    console.log(error);
  }).finally(() => {
    //console.log("finally");

  });

  //console.log(idRole, idUser);
}

function createNavModules(data) {
  const navModules = document.getElementById('nav-pages');
  navModules.innerHTML = ` <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="bi bi-info-square-fill"></i> Sin resultados
                </a>
            </li>`;
  //console.log(data)
  let getModulesRolesUser = data['data'][0];
  let modulesLong = getModulesRolesUser.length;
  let contentNav = "";
  //console.log(modulesLong);
  if (modulesLong > 0) {
    navModules.innerHTML = "";
    for (let i = 0; i < modulesLong; i++) {
      contentNav += ` <li class="nav-item">
                <a class="nav-link" href="${getModulesRolesUser[i].route}">
                    <i class="bi ${getModulesRolesUser[i].icon}"></i> ${getModulesRolesUser[i].name}
                </a>
            </li>`;
    }
    navModules.innerHTML = contentNav;
  }

}