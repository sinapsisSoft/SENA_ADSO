

const objForm = new Form('loginForm', 'edit-input');
const myForm = objForm.getForm();
const appStorage = new AppStorage();

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
    console.log("Insert");
    httpMethod = METHODS[1]; // POST method
    endpointUrl = URL_LOGIN;
    documentData = objForm.getDataForm();
    
    const resultServices = getDataServices(documentData, httpMethod, endpointUrl);
    resultServices.then(response => {
        return response.json();
    }).then(data => {
        console.log(data['user'].token);
        if(appStorage.setItem(KEY_TOKEN,data['user'].token)){
            console.log("Token saved successfully");
            window.location.href = "../user/index.html"; // Redirect to index page
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

