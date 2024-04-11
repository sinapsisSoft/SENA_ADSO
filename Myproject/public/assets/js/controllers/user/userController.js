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
const idInputPasswordRP = 'repeatPassword';
const idInputPassword = 'User_password';
const btnPasswordRP = document.getElementById('btn-passwordRP');
const btnPassword = document.getElementById('btn-password');
const myModal = new bootstrap.Modal(document.getElementById("modalApp"), {});
const textConfirm = "Press a button to Delete!\nAccept or Cancel.";

var primaryKey = "User_id";
var validate = true;
var setJson = {};
var postData;
var type;
var uri;


/**Function hidden modal*/
function create() {
  validate = true;
  objForm.cleanForm();
  objForm.enableForm();
  btnSubmit.disabled = false;
  showModal();
}

/**Function show user*/
function showId(id) {

  objForm.cleanForm();
  objForm.disableForm();
  btnSubmit.disabled = true;
  setJson[primaryKey] = id;

  type = 'POST';
  uri = 'user/showId';
  sendData(setJson, type, uri)
  .then(data => {
    console.log(data['data'][0]);
    objForm.sendDataForm(data['data'][0]);
  })
  .catch(error => console.error(error))
  .finally(hidePreload());
  showModal();

}

/**Function edit user*/
function edit(id) {
  validate = false;
  objForm.cleanForm();
  objForm.enableForm();
  btnSubmit.disabled = false;
  setJson[primaryKey] = id;
  type = 'POST';
  uri = 'user/showId';
  sendData(setJson, type, uri)
    .then(data => {
      //console.log(data['data'][0]);
      objForm.sendDataForm(data['data'][0]);
    })
    .catch(error => console.error(error))
    .finally(hidePreload());
  showModal();
}

/**Function delete user*/
function delete_(id) {

  setJson[primaryKey] = id;
  type = 'DELETE';
  uri = 'user/delete';
  if (confirm(textConfirm) == true) {
    sendData(setJson, type, uri)
      .then(data => {
        console.log(data['data'][0]);
        setLocations("user/");
      })
      .catch(error => console.error(error))
      .finally(hidePreload());
  } else {

  }
}

/**Function show modal*/
function showModal() {
  myModal.show();
};

/**Function hidden modal*/
function hideModal() {
  myModal.hide();
}
/**Function show preload*/
function showPreload() {
  preload.style.display = "block";
};

/**Function hidden preload*/
function hidePreload() {
  preload.style.display = "none";
}

/* This code snippet is adding an event listener to the button element with the ID 'btn-password'. When
this button is clicked, the function `FunApp.viewText(idInputPassword)` is executed. */
if (btnPassword)
  btnPassword.addEventListener('click', (e) => {
    objForm.viewText(idInputPassword);
  });

/* This code snippet is adding an event listener to the button element with the ID 'btnPasswordRP'.
When this button is clicked, it calls the function `FunApp.viewText(idInputPasswordRP)`. This
function is likely responsible for displaying or manipulating the text input associated with the ID
'repeatPassword'. */
if (btnPasswordRP)
  btnPasswordRP.addEventListener('click', (e) => {
    objForm.viewText(idInputPasswordRP);
  });


getForm.addEventListener('submit', async (e) => {
  e.preventDefault();

  if (objForm.setValidateForm()) {
    postData = objForm.getJsonForm();
    if (validate) {
      type = 'POST';
      uri = 'user/create';
      sendData(postData, type, uri)
        .then(data => {
          console.log(data);
          hideModal();
          setLocations("user/");
        })
        .catch(error => console.error(error))
        .finally(hidePreload());
    } else {
      type = 'PUT';
      uri = 'user/edit';
      sendData(postData, type, uri)
        .then(data => {
          console.log(data);
          hideModal();
          setLocations("user/");
        })
        .catch(error => console.error(error))
        .finally(hidePreload());
    }

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