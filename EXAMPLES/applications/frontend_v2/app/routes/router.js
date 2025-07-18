// public/js/router.js
const routes = {
  '#dashboard': '../app/views/dashboard/index.html',
  '#user': '../app/views/user/index.html',
  '#role': '../app/views/role/index.html',
  '#documentType': '../app/views/documentType/index.html',
  '#profile': '../app/views/profile/index.html',
  '#userStatus': '../app/views/userStatus/index.html',
  '#module': '../app/views/module/index.html',
  '#roleModule': '../app/views/roleModule/index.html',
  '#error404': '../app/views/errors/404.html',
  '#auth': '../app/views/auth/index.html'

};
const contentFrame = document.getElementById('contentFrame');
contentFrame.style.display = 'none';
const routerLogin="#auth";

const Router = function () {
  const self = this;
  this.routes = {};
  this.currentRoute = '';
  this.currentIframe = null;
  this.init = function () {
    window.addEventListener('popstate', function () { self.routeChange(); });
    document.addEventListener('DOMContentLoaded', function () { self.routeChange(); });
  };
  this.addRoute = function (path, callback) {
    this.routes[path] = callback;
  };

  this.routeChange = function () {
    this.currentRoute = window.location.hash || '#dashboard';
    const viewPath = routes[this.currentRoute] || routes['#error404'];
    console.log(this.currentRoute);
    if(this.currentRoute==routerLogin){
     // alert();
    }
    contentFrame.src = viewPath;
    // document.querySelectorAll('.nav-link').forEach(link => {
    //   link.classList.toggle('active', link.getAttribute('href') === hash);
    // });

  };

  this.navigateTo = function (path, params = {}) {
    const queryString = Object.keys(params).map(key =>
      `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`
    ).join('&');

    const fullPath = queryString ? `${path}?${queryString}` : path;
    window.history.pushState({}, '', fullPath);
    this.routeChange();
  };

  this.loadView = function (viewPath, params) {
    // Clear previous iframe if it exists
    if (this.currentIframe) {
      this.currentIframe.remove();
    }

// Create new iframe
    const iframe = document.createElement('iframe');
    iframe.id = 'view-iframe';
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    iframe.style.border = 'none';
    iframe.onload = function () {
      self.sendParamsToIframe(iframe, params);
    };
// Set iframe font with parameters
    const queryString = Object.keys(params).map(key =>
      `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`
    ).join('&');

    iframe.src = `../app/views${viewPath}.html${queryString ? '?' + queryString : ''}`;
    debugger
    document.getElementById('main-content').innerHTML = '';
    document.getElementById('main-content').appendChild(iframe);
    this.currentIframe = iframe;
  };

  this.sendParamsToIframe = function (iframe, params) {
    try {
      iframe.contentWindow.postMessage({
        type: 'ROUTER_PARAMS',
        params: params
      }, window.location.origin);
    } catch (e) {
      console.log('No se pueden enviar parámetros al iframe:', e);
    }
  };

  this.init();
};

// Crear instancia global del router
window.router = new Router();

// Escuchar mensajes desde iframes
window.addEventListener('message', function (event) {
  if (event.data.type === 'NAVIGATE_REQUEST') {
    router.navigateTo(event.data.path, event.data.params);
  }
});

