/**
 * Author:DIEGO CASALLAS
 * Date:04/04/2024
 * Description:These are the functions for managing user .
 * 
*/
/**DEFINE*/
const idForm = "my-form";
const objForm = new Form(idForm);
const getForm = objForm.getForm();
const btnSubmit = document.getElementById('btnSubmit');
const preload = document.getElementById('preload');

var primaryKey = "User_id";
var setJson = {};
var postData;
var type;
var uri;


/**Function login */
function login() {
 
}

/**Function show preload*/
function showPreload() {
  preload.style.display = "block";
};

/**Function hidden preload*/
function hidePreload() {
  preload.style.display = "none";
}

getForm.addEventListener('submit', async (e) => {
  e.preventDefault();

  if (objForm.setValidateForm()) {
    postData = objForm.getJsonForm();
  
      type = 'POST';
      uri = 'login/login';
      sendData(postData, type, uri)
        .then(data => {
          console.log(data);
 
          //setLocations("user/");
        })
        .catch(error => console.error(error))
        .finally(hidePreload());
  }
});

/*Function async send Data General**/
async function sendData(data, type, uri) {
  showPreload();
  return fetch(BASE_URL + uri, {
    method: type,
    headers: { "Content-type": "application/json;charset=utf-8" },
    body: JSON.stringify(data),
  }).then(response => response.json())
}

function setLocations(uri) {
  let newLocations = BASE_URL + uri;
  window.location.assign(newLocations);
}

/*Function load view html**/
window.addEventListener('load', (e) => {

});