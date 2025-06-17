document.addEventListener('DOMContentLoaded', async function() {
const contentFrame = document.getElementById('contentFrame');
  document.querySelector('body').style.display = 'none';
  document.querySelector('body').style.opacity = 0;
await checkAuth();
console.log('Content controller has been loaded');
fadeInElement(document.querySelector('body'), 1000);

/*Routes for the application*/
const routes = {
  '#dashboard': 'views/dashboard/index.html',
  '#user': 'views/user/index.html',
  '#role': 'views/role/index.html',
  '#documentType': 'views/documentType/index.html',
  '#profile': 'views/profile/index.html',
  '#userStatus': 'views/userStatus/index.html'
};

function loadContent() {
  const hash = window.location.hash || '#dashboard';
  const viewPath = routes[hash] || routes['#dashboard'];
  contentFrame.src = viewPath;
  document.querySelectorAll('.nav-link').forEach(link => {
    link.classList.toggle('active', link.getAttribute('href') === hash);
  });
}

loadContent();
window.addEventListener('hashchange', loadContent);

});