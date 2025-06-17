document.addEventListener('DOMContentLoaded', async function() {
  const contentFrame = document.getElementById('contentFrame');
  document.querySelector('body').style.display = 'none';
  document.querySelector('body').style.opacity = 0;
 
  await checkAuth();
   console.log('login controller has been loaded');
  fadeInElement(document.querySelector('body'), 1000);
  // Mapeo de rutas a vistas
  const routes = {
    '#dashboard': 'views/dashboard/index.html',
    '#user': 'views/user/index.html',
    '#role': 'views/role/index.html',
    '#documentType': 'views/documentType/index.html',
    '#profile': 'views/profile/index.html',
    '#salary': 'views/salary/index.html',
    '#upload': 'views/upload/index.html',
    '#userStatus': 'views/userStatus/index.html'
  };

  // Función para cargar la vista según el hash
  function loadView() {
    const hash = window.location.hash || '#dashboard';
    const viewPath = routes[hash] || routes['#dashboard'];
    contentFrame.src = viewPath;
    
    // Actualizar clase activa en navegación
    document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.toggle('active', link.getAttribute('href') === hash);
    });
  }

  // Cargar vista inicial
  loadView();

  // Escuchar cambios en el hash
  window.addEventListener('hashchange', loadView);
});