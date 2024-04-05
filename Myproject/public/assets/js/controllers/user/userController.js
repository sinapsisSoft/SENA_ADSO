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

var primaryKey = "";
var validate = true;


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
  showPreload();
  primaryKey = id;
  objForm.cleanForm();
  objForm.disableForm();
  btnSubmit.disabled = true;
  showModal();
}

/**Function edit user*/
function edit(id) {
  showPreload();
  primaryKey = id;
  validate = false;
  objForm.cleanForm();
  objForm.enableForm();
  btnSubmit.disabled = false;
  showModal();
}

/**Function delete user*/
function delete_(id) {
  showPreload();
  primaryKey = id;
  hidePreload();
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

getForm.addEventListener('submit', (e) => {
  e.preventDefault();

  getValidateForm();
});

function getValidateForm() {
  let elements = getForm.querySelectorAll('input');



}

function validateForm(idForm) {
  // Obtener el formulario
  const objForm = document.getElementById(idForm);

  // Obtener todos los inputs del formulario
  const inputs = objForm.querySelectorAll('input');

  // Variable para almacenar si el formulario es válido
  let formValidate = true;

  // Recorrer cada input y validarlo
  for (const input of inputs) {
    // Si el input no es válido, mostrar un mensaje de error y cambiar la variable
    if (!validateInput(input)) {  
      formValidate = false;
      showMessageError(input);
    }
  }

  // Si el formulario es válido, enviar el formulario
  if (formValidate) {
    objForm.submit();
  }

  // Función para validar un input
  function validateInput(input) {
    // Obtener el tipo de input
    const type = input.type;

    // Validar según el tipo de input
    switch (type) {
      case 'text':
        return validateText(input);
      case 'email':
        return validateEmail(input);
      case 'password':
        return validatePassword(input);
      case 'number':
        return validateNumber(input);
      default:
        return true;
    }
  }
 

  // Funciones para validar cada tipo de input
  function validateText(input) {
    // Validar que no esté vacío
    if (input.value === '') {
      return false;
    }
    return true;
  }

  function validateEmail(input) {
    // Validar que tenga un formato de email válido
    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(input.value);
  }

  function validatePassword(input) {
    // Validar que tenga una longitud mínima
    if (input.value.length < 8) {
      return false;
    }
    return true;
  }

  function validateNumber(input) {
    // Validar que sea un número
    if (isNaN(input.value)) {
      return false;
    }
    return true;
  }

  // Función para mostrar un mensaje de error
  function showMessageError(input) {
    // Agregar una clase de error al input
    input.classList.add('error');

    // Mostrar un mensaje de error debajo del input
    const messageError = document.createElement('span');
    messageError.classList.add('mensaje-error');
    messageError.textContent = 'Este campo es inválido';
    input.parentNode.appendChild(messageError);
  }
}




/*Function load view html**/
window.addEventListener('load', (e) => {

});