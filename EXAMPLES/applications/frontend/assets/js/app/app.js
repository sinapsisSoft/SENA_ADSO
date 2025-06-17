

async function checkAuth() {
  toggleLoading(true);
  const storage = new AppStorage();
  const getToken = storage.getItem(KEY_TOKEN);
  const moduleLogin = "auth/";
  const moduleDashboard = "/dashboard/";
  const getUrl = window.location.href;

  if (!getToken) {
    //console.log("No token found, redirecting to login page.");
    // No token found, redirecting to login page.
    if (!getUrl.includes(moduleLogin)) {
      window.location.href = `views/auth`
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

      //console.log(data['valid']);
      if (data['valid']) {
        // Token is valid, redirect to dashboard if not already there

        if (getUrl.includes(moduleLogin)) {
          window.history.back();
          window.history.forward();
          return true;
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

const loadingScreen = document.getElementById('loading-screen');
// Function to show/hide the loader
function toggleLoading(show) {
  loadingScreen.style.display = show ? 'flex' : 'none';
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
  var interval = setInterval(function() {
    opacity += 0.1;
    element.style.opacity = opacity;
    if (opacity >= 1) {
      clearInterval(interval);
    }
  }, 50); // Adjust the interval for speed
}