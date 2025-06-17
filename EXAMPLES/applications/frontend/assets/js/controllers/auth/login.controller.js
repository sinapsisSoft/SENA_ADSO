
document.addEventListener('DOMContentLoaded', async ()=> {
  document.querySelector('body').style.display = 'none';
  document.querySelector('body').style.opacity = 0;
 
  await checkAuth();
  console.log('login controller has been loaded');
  fadeInElement(document.querySelector('body'), 1000);
  // Initialize the loading screen
    
});


const objForm = new Form('loginForm', 'edit-input');
const appStorage = new AppStorage();
const myForm = objForm.getForm();

let documentData = "";
let httpMethod = "";
let endpointUrl = "";

myForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  if (!objForm.validateForm()) {
    console.log("Error");
    return;
  }
  toggleLoading(true);
  console.log("Login Form Submitted");
  httpMethod = METHODS[1]; // POST method
  endpointUrl = URL_LOGIN;
  documentData = objForm.getDataForm();
  const resultServices = getDataServices(documentData, httpMethod, endpointUrl);
  resultServices.then(response => {
    return response.json();
  }).then(data => {
    //console.log(data);
    if (data['status'] === 'error') {
      console.log("Error in login");
      toggleLoading(false);
      return;
    } else {
      appStorage.setItem(KEY_TOKEN, data['user'].token);
      console.log("Login Success");
      window.location.href = '../../';
    }
  }).catch(error => {
    console.log(error);
  }).finally(() => {
    //console.log("finally");
    toggleLoading(false);
  });
});

window.addEventListener('load', () => {

});

