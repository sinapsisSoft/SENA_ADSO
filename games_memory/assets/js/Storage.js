
const STORAGE = window.localStorage;
const ModelUsers = "users";
var archivoJSON = JSON.parse(getDataStorage(ModelUsers));
var newUser = "";
var getInput;
createTableUser();
document.getElementById('FormUser').addEventListener('submit', function (event) {
  getInput = this.querySelector("input[type='text']");
  newUser = { username: getInput.value.toUpperCase(), points: 0, };

  // Validar y agregar el nuevo usuario
  archivoJSON = validarYAgregarUsuario(archivoJSON, newUser);

    setDataStorage(archivoJSON);
 
    alert(`BIENVENIEDO ${getInput.value.toUpperCase()}`);
  
  setLocation('../../games.html?username='+getInput.value.toUpperCase()+'&points=0');
  event.preventDefault();
});


function validarYAgregarUsuario(jsonData, nuevoUsuario) {
  // Verificar si el archivo JSON está vacío
  if (Object.keys(jsonData).length === 0) {
    // Si está vacío, agregar el nuevo usuario directamente
    jsonData.users = [nuevoUsuario];
  } else {
    // Si no está vacío, verificar si el usuario ya existe
    if (!jsonData.users) {
      jsonData.users = [];
    }

    const usuariosExistentes = jsonData.users.map(user => user.username);

    if (!usuariosExistentes.includes(nuevoUsuario.username)) {
      // Si el usuario no existe, agregarlo
      jsonData.users.push(nuevoUsuario);

    } else {
      // Si el usuario ya existe, no hacer nada
      console.log("El usuario ya existe en el JSON.");
    }
  }

  return jsonData;
}


// Mostrar el archivo JSON actualizado
function setDataStorage(jsonData) {
  
  let getData = JSON.parse(getDataStorage(ModelUsers));
  
  if (getData[ModelUsers].length <= 10) {
    localStorage.setItem(ModelUsers, JSON.stringify(jsonData, null));

  }
}
function setLocation(route) {
  location.href = route;
}
function getDataStorage(obj) {

  let getData = localStorage.getItem(obj);
  if (getData == null) {
    getData = '{"'+obj+'":[]}';
  }

  return getData;
}

function createTableUser() {
  let getData = JSON.parse(localStorage.getItem(ModelUsers));
  var newOptions = '<option value="0" selected style="font-size: 1.5em;">SELECT PROFILE</option>';
  var contSelect = document.getElementById('selectProfile');
  if (getData != null) {

   

    getData[ModelUsers].forEach(element => {
      newOptions += '<option value="' + element.username + '">' + element.username + '</option>';
    });
    
  }
  contSelect.innerHTML = newOptions;
}


function getProfile(data) {
  if (data != 0) {
    document.getElementById('Username').value = data;
  }
}


