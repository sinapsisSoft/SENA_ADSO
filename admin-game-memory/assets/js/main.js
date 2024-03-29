/**
 * Author:DIEGO CASALLAS
 * Date:27/03/2024
 * Description:These are the functions for managing data from FIREBASE.
 * 
*/
/**DEFINE*/
const tbodyId = "tbody";
const firebaseGame = new FirebaseGameUser(tbodyId);
const formUser = document.getElementById('formUser');
const btnSubmit = document.getElementById('btnSubmit');
const preload = document.getElementById('preload');
const myModal = new bootstrap.Modal(document.getElementById("modalApp"), {});
const textConfirm = "Press a button to Delete!\nAccept or Cancel.";

var getIdUser = "";
var validate = true;

/**Function get user data*/
function getDataUser() {
  showPreload();
  firebaseGame.getDataUsers().then((result)=>{
    hidePreload();
  });
}

/**Function hidden modal*/
function createUser() {
  validate = true;
  cleanForm();
  enableForm();
  btnSubmit.disabled = false;
  showModal();
}

/**Function show user*/
function showUser(id) {
  cleanForm();
  disableForm();
  showPreload();
  const dataUser = firebaseGame.getDataUser(id);
  dataUser.then((data) => {
    setDataForm(data);
    hidePreload();
  });
  btnSubmit.disabled = true;
  showModal();
}

/**Function edit user*/
function editUser(id) {
  validate = false;
  cleanForm();
  enableForm();
  showPreload();
  getIdUser = id;
  const dataUser = firebaseGame.getDataUser(id);
  dataUser.then((data) => {
    setDataForm(data);
    hidePreload();
  });
  btnSubmit.disabled = false;
  showModal();
}

/**Function delete user*/
function deleteUser(id) {
  showPreload();
  if (confirm(textConfirm) == true) {
    firebaseGame.setDeleteUser(id).then((data) => {
      getDataUser();
    });
  }
  hidePreload();
}

/**Function get data form modal*/
formUser.addEventListener('submit', (e) => {
  e.preventDefault();
  let inputId = document.getElementById('id');
  if (inputId.value.length === 0) {
    inputId.value = uuid.v1();
  }
  let elements = formUser.querySelectorAll('input');
  var jsonArray = {};
  for (const elem of elements) {
    jsonArray[elem.id] = elem.value;
  }
  if (validate) {
    firebaseGame.setCreateUser(jsonArray).then(hideModal());
  } else {
    firebaseGame.setUpdateUser(getIdUser, jsonArray).then(hideModal());
  }
});

/**Function show modal*/
function showModal() {
  myModal.show();
};

/**Function hidden modal*/
function hideModal() {
  myModal.hide();
}

/**Function clean form*/
function cleanForm() {
  formUser.reset();
};

/**Function enable form*/
function enableForm() {
  let elements = formUser.querySelectorAll("input");
  for (let i = 0; i < elements.length; i++) {
    elements[i].disabled = false;
  }
};

/**Function disabled form*/
function disableForm() {
  let elements = formUser.querySelectorAll("input");
  for (let i = 0; i < elements.length; i++) {
    elements[i].disabled = true;
  }
};

/**Function to send data to the form*/
function setDataForm(data) {
  let elements = formUser.querySelectorAll("input");
  for (let i = 0; i < elements.length; i++) {
    document.getElementById(elements[i].id).value = data[elements[i].id];
  }
};
/**Function show preload*/
function showPreload() {
  preload.style.display = "block";
};

/**Function hidden preload*/
function hidePreload() {
  preload.style.display = "none";
}
/*Function load view html**/
window.addEventListener('load', (e) => {
  getDataUser();
});