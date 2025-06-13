document.addEventListener('DOMContentLoaded', async ()=> {
  document.querySelector('body').style.display = 'none';
  document.querySelector('body').style.opacity = 0;
 
  await checkAuth();
  console.log('dashboard controller has been loaded');
  fadeInElement(document.querySelector('body'), 1000);
  // Initialize the loading screen
    
});