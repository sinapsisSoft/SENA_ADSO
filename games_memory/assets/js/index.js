/*
Author:DIEGO CASALLAS
Date:19/03/2024
Description:This functions 
*/

/**Variables declarations*/
const modelStorage = "User"; //This variable contains the name of the local storge model.
const objForm = "FormUser"; //This variable contains the object of the form.
const objSelect = "profile"; //This variable contains the object of the select.
const uri = "./games.html"; //This variable contains the object of the form.
const storageGame = new StorageGame("User"); //This object Class Storage.


/**This form gets the form data**/
function getDataForm(obj) {
  let getData = obj.value;
  if (getData != "" || getData.length != 0) {
    getData = getData.toUpperCase();
    setDataStorage(getData);
    //setLocation(uri + '?' + getData);

  } else {
    alert("Error: data validation");
    obj.focus();
  }
}
/**This set data Storage**/
function setDataStorage(data) {
  let object = '{"' + modelStorage + '":[{"user":"' + data + '","points":0}]}';
  storageGame.setStorage(object)
}
/**This locations**/
function setLocation(route) {
  location.href = route;
}

/**This create Select html**/
function setCreateSelect(getJson) {
  var newOptions = '<option value="0" selected style="font-size: 1.5em;">SELECT PROFILE</option>';
  var contSelect = document.getElementById(objSelect);
  let getData = JSON.parse(getJson);
  if (getData != null) {
    getData[modelStorage].forEach(element => {
      newOptions += '<option value="' + element.user + '">' + element.user + '</option>';
    });
  }
  contSelect.innerHTML = newOptions;
}
/**This create Select html**/
function setProfile(data) {
  let objInput = document.getElementById('username');
  if (data != 0) {
    objInput.value = data;
  } else {
    objInput.value = "";
  }
}
/**This get event submit **/
document.getElementById(objForm).addEventListener('submit', function (event) {
  let element = this.querySelector('input[type=text]');
  getDataForm(element);
  event.preventDefault();
})

function getDataUser(){
  if(localStorage.length!=0){
    setCreateSelect(storageGame.getStorage());
  }
}


/**This load view**/
window.addEventListener('load', () => {
  getDataUser();
});

function validarYAgregarUsuario(jsonData, nuevoUsuario) {
  // Verificar si el archivo JSON está vacío


  if (Object.keys(jsonData).length === 0) {
    // Si está vacío, agregar el nuevo usuario directamente
    jsonData.User = [nuevoUsuario];
  } else {
    // Si no está vacío, verificar si el usuario ya existe
    if (!jsonData.User) {
      jsonData.User = [];
    }

    const usuariosExistentes = jsonData.User.map(user => user.username);

    if (!usuariosExistentes.includes(nuevoUsuario.username)) {
      // Si el usuario no existe, agregarlo
      jsonData.User.push(nuevoUsuario);

    } else {
      // Si el usuario ya existe, no hacer nada
      console.log("El usuario ya existe en el JSON.");
    }
  }

  return jsonData;
}




