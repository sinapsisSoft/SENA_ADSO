

const objForm = new Form('loginForm', 'edit-input');
const appStorage=new AppStorage();
const myForm = objForm.getForm();

let documentData = "";
let httpMethod = "";
let endpointUrl = "";

myForm.addEventListener('submit', (e) => {
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
    console.log(data);
    if (data['status'] === 'error') {
      console.log("Error in login");
      toggleLoading(false);
      return;
    }
    appStorage.setItem(KEY_TOKEN, data['user'].token);
    
  }).catch(error => {
    console.log(error);
  }).finally(() => {
    //console.log("finally");
    toggleLoading(false);
  });
});

window.addEventListener('load', () => {

});

