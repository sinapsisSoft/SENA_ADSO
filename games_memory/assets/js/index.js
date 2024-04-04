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
var ObjJSON = JSON.parse(storageGame.getStorage());

/**This form gets the form data**/
function getDataForm(obj) {
  let getData = obj.value;
  if (getData != "" || getData.length != 0) {
    getData = getData.toUpperCase();
    setDataStorage(getData);
    setLocation(uri + '?user=' + getData+'&points=0');

  } else {
    alert("Error: data validation");
    obj.focus();
  }
}
/**This set data Storage**/
function setDataStorage(data) {

  let object = '{"' + modelStorage + '":[{"user":"' + data + '","points":0}]}';
  if (ObjJSON == null) {
    storageGame.setStorage(object);
  } else {
    object = '{"user":"' + data + '","points":0}';
    ObjJSON = validateUserRegister(ObjJSON, object);
    storageGame.setStorage(JSON.stringify(ObjJSON));
  }
}

function validateUserRegister(jsonStorage, objectUser) {
  if (Object.keys(jsonStorage).length === 0) {
    jsonStorage.User = [objectUser];
  } else {
    if (!jsonStorage.User) {
      jsonStorage.User = [];
    }
    let getDataObjet = JSON.parse(objectUser);
    let nameUser = jsonStorage.User.map(user => user.user);
    if (!nameUser.includes(getDataObjet.user)) {
      jsonStorage.User.push(getDataObjet);
    } else {
      console.log("El usuario ya existe en el JSON.");
    }
  }
  return jsonStorage;

}
/**This locations**/
function setLocation(route) {
  console.log(route);
  location.href = route;
}

/**This create Select html**/
/**
 * The function `setCreateSelect` populates a select element with options based on JSON data.
 * @param getJson - The `getJson` parameter is likely a JSON string that contains data to populate the
 * select element with options. This data is expected to be parsed into an object using `JSON.parse`
 * within the `setCreateSelect` function.
 */
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
/**
 * The function setProfile takes a data input and sets the value of the element with id 'username' to
 * the data if it is not 0, otherwise it sets it to an empty string.
 * @param data - The `data` parameter in the `setProfile` function is used to pass a value that will be
 * set as the value of the input field with the id 'username'. If the `data` is not equal to 0, it will
 * set the value of the input field to the `data
 */
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

/**
 * The function `getDataUser` checks if there is data in the localStorage and then calls
 * `setCreateSelect` with the data retrieved from `storageGame.getStorage()`.
 */
function getDataUser() {
  if (localStorage.length != 0) {
    setCreateSelect(storageGame.getStorage());
  }
}

/**This load view**/
window.addEventListener('load', () => {
  getDataUser();
});





