/* Author:DIEGO CASALLAS
* Date:17/05/2024
* Descriptions:This is controller role - module - permission 
* **/


/* The code snippet you provided is setting up various constants and initializing the `mainApp` object
with specific parameters. Here is a breakdown of what each line is doing: */
const formId = ['my-form', 'my-formPermission'];
const modalId = ['my-modal', 'my-modalPermission'];
const model = 'roleModules';
const tableId = 'table-index';
const tableModuleId = 'table-module';
const tablePermissionsId = 'table-permissions';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const btnSubmit = document.getElementById('btnSubmit');
const mainApp = new Main(modalId, formId, classEdit, preloadId);


/* The variables `insertUpdate`, `url`, `method`, `data`, and `resultFetch` are being initialized in
the provided code snippet. Here is a breakdown of what each variable is intended for: */
var insertUpdate = true;
var url = "";
var method = "";
var data = "";
var resultFetch = null;


/**
 * The `add` function resets a form, enables all form elements, sets a flag to insert or update data,
 * disables a button, and shows a modal.
 */
function add() {
  mainApp.resetForm();
  mainApp.enableFormAll();
  insertUpdate = true;
  btnEnabled(false);
  mainApp.showModal();
}

/**
 * The function `editModules` resets a form, disables form editing, retrieves data based on module and
 * role IDs, and disables a button.
 * @param id - The `id` parameter is likely used to identify a specific module within the system. It
 * could be an identifier such as a module ID or a unique key that distinguishes one module from
 * another. This parameter is essential for targeting the specific module that needs to be edited or
 * updated.
 * @param idRoleModule - The `idRoleModule` parameter likely refers to the ID of a role module in a
 * system or application. This ID is used to identify a specific role module that needs to be edited or
 * updated.
 */
function editModules(id, idRoleModule) {
  mainApp.resetForm();
  mainApp.disabledFormEdit();
  insertUpdate = false;
  btnEnabled(false);
  getDataModuleId(id, idRoleModule);
}

/**
 * The function `getDataModuleId` fetches data from a specified URL, processes the response, sets form
 * data, and displays a modal while handling errors and preload states.
 * @param id - The `id` parameter in the `getDataModuleId` function is used to specify the ID of the
 * module for which you want to retrieve data.
 * @param idRoleModule - The `idRoleModule` parameter in the `getDataModuleId` function is used to
 * specify the ID of the role module that is being passed as a parameter to the function. This ID is
 * then used within the function to perform certain operations, such as setting the `RoleModules_id`
 * property in
 */
async function getDataModuleId(id, idRoleModule) {
  method = 'GET';
  url = URI_ROLE_MODULE + LIST_CRUD[1] + 'Modules' + '/' + id;
  data = "";
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data);
      ///Set data form 
      let newJson = convertJson(data[model]);
      newJson.Roles_id = id;
      newJson.RoleModules_id = idRoleModule;
      mainApp.setDataFormJson(newJson);
      //show Modal 
      mainApp.showModal();
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .catch(error => {
      console.error(error);
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .finally();
}

/**
 * The function `editPermissions` resets and disables a form, retrieves data based on an ID and role
 * module, and disables a button.
 * @param id - The `id` parameter is likely referring to the unique identifier of a specific permission
 * or user in the system.
 * @param idRoleModule - The `idRoleModule` parameter likely refers to the ID of a role module in a
 * system or application. This ID is used to identify a specific role module for which permissions are
 * being edited in the `editPermissions` function.
 */
function editPermissions(id, idRoleModule) {
  mainApp.resetForm(1);
  mainApp.disabledFormEdit(1);
  insertUpdate = false;
  btnEnabled(false);
  getDataPermissionId(id, idRoleModule);
}

/**
 * The function `getDataPermissionId` fetches permission data based on the provided `id` and
 * `idRoleModule`, processes the data, sets it in a form, and then displays a modal with the data.
 * @param id - The `id` parameter in the `getDataPermissionId` function is used to specify the ID of
 * the permission for which you want to retrieve data.
 * @param idRoleModule - The `idRoleModule` parameter in the `getDataPermissionId` function is used to
 * specify the ID of the role module for which you want to retrieve data permissions. This ID is likely
 * used to identify a specific role module in the system, allowing the function to fetch the
 * corresponding data permissions associated with
 */
async function getDataPermissionId(id, idRoleModule) {
  method = 'GET';
  url = URI_ROLE_MODULE + LIST_CRUD[1] + 'Permission' + '/' + idRoleModule;
  data = "";
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data[model]);

      ///Set data form
      let newJson = convertJson(data[model]);
      newJson.Modules_id = id;
      newJson.RoleModules_id = idRoleModule;
      mainApp.setDataFormJson(newJson, 1);
      //show Modal 
      mainApp.showModal(1);
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .catch(error => {
      console.error(error);
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .finally();
}


mainApp.getForm().addEventListener('submit', async function (event) {
  event.preventDefault();
  if (mainApp.setValidateForm()) {
    //Show Preload 
    mainApp.showPreload();
    if (insertUpdate) {
      method = 'POST';
      url = URI_ROLE_MODULE + LIST_CRUD[0];
      data = mainApp.getDataFormJson();
      console.log(data);
      // resultFetch = getData(data, method, url);
      // resultFetch.then(response => response.json())
      //   .then(data => {
      //     //console.log(data);
      //     //show Modal 
      //     mainApp.hiddenModal();
      //     //Reload View
      //     reloadPage();
      //   })
      //   .catch(error => {
      //     console.error(error);
      //     //hidden Preload 
      //     mainApp.hiddenPreload();
      //   })
      //   .finally();
    } else {
      method = 'POST';
      url = URI_ROLE_MODULE + LIST_CRUD[2];
      data = mainApp.getDataFormJson();
      console.log(data);
      // resultFetch = getData(data, method, url);
      // resultFetch.then(response => response.json())
      //   .then(data => {
      //     //console.log(data);
      //     //show Modal 
      //     mainApp.hiddenModal();
      //     //Reload View
      //     reloadPage();
      //   })
      //   .catch(error => {
      //     console.error(error);
      //     //hidden Preload 
      //     mainApp.hiddenPreload();
      //   })
      //   .finally();
    }
  } else {
    alert("Data Validate");
    mainApp.resetForm();
  }
});
/* The code snippet you provided is an event listener attached to the form element within the `mainApp`
object. It listens for the `submit` event on the form and executes a series of actions when the form
is submitted. Here is a breakdown of what the code is doing: */
mainApp.getForm(1).addEventListener('submit', async function (event) {
  event.preventDefault();
  alert();
  if (mainApp.setValidateForm(1)) {
    //Show Preload 
    mainApp.showPreload();
    if (insertUpdate) {
      method = 'POST';
      url = URI_ROLE_MODULE + LIST_CRUD[0];
      data = mainApp.getDataFormJson(1);
      console.log(data);
      // resultFetch = getData(data, method, url);
      // resultFetch.then(response => response.json())
      //   .then(data => {
      //     //console.log(data);
      //     //show Modal 
      //     mainApp.hiddenModal();
      //     //Reload View
      //     reloadPage();
      //   })
      //   .catch(error => {
      //     console.error(error);
      //     //hidden Preload 
      //     mainApp.hiddenPreload();
      //   })
      //   .finally();
    } else {
      method = 'POST';
      url = URI_ROLE_MODULE + LIST_CRUD[2];
      data = mainApp.getDataFormJson(1);
      console.log(data);
      // resultFetch = getData(data, method, url);
      // resultFetch.then(response => response.json())
      //   .then(data => {
      //     //console.log(data);
      //     //show Modal 
      //     mainApp.hiddenModal();
      //     //Reload View
      //     reloadPage();
      //   })
      //   .catch(error => {
      //     console.error(error);
      //     //hidden Preload 
      //     mainApp.hiddenPreload();
      //   })
      //   .finally();
    }
  } else {
    alert("Data Validate");
    mainApp.resetForm(1);
  }
});

/**
 * The function `convertJson` takes an array of JSON data and converts it into a new JSON object with
 * key-value pairs.
 * @param jsonData - An array of objects in JSON format.
 * @returns The function `convertJson` takes an array of JSON objects as input, extracts the key-value
 * pairs from each object, and creates a new JSON object with these key-value pairs. The function then
 * returns this new JSON object.
 */
function convertJson(jsonData) {
  var newJson = {};
  for (let i = 0; i < jsonData.length; i++) {
    let elements = Object.values(jsonData[i]);
    newJson[elements[0]] = elements[1];
  }
  return newJson;
}

/**
 * The function `getModels` checks if the input value is not equal to 0, then calls `getDataModuleId`
 * with that value and resets the form using `mainApp.resetForm()`.
 * @param value - The `value` parameter is a variable that is being passed to the `getModels` function.
 * The function checks if the `value` is not equal to 0, and if true, it calls the `getDataModuleId`
 * function with the `value` as an argument. Finally, the
 */
function getModels(value) {
  if (value != 0) {
    getDataModuleId(value);
  }
  mainApp.resetForm();
}

/**
 * The function `btnEnabled` is used to enable or disable a button based on the `type` parameter.
 * @param type - The `type` parameter in the `btnEnabled` function is used to determine whether the
 * button should be enabled or disabled. If `type` is `true`, the button will be disabled, and if
 * `type` is `false`, the button will be enabled.
 */
function btnEnabled(type) {
  btnSubmit.disabled = type;
}

/**
 * The function `getData` is an asynchronous function that sends a request to a specified URL using the
 * specified method and data.
 * @param data - The `data` parameter in the `getData` function represents the data that will be sent
 * in the request body when making a POST or PUT request. It should be an object containing the data
 * you want to send to the server in JSON format.
 * @param method - The `method` parameter in the `getData` function specifies the HTTP request method
 * to be used for the API call. It can be either "GET" or another HTTP method like "POST", "PUT",
 * "DELETE", etc.
 * @param url - The `url` parameter in the `getData` function is the URL to which the HTTP request will
 * be sent. It specifies the location of the resource that the function will interact with.
 * @returns The function `getData` is returning the result of the `fetch` function with the specified
 * `url` and `parameters`. The `fetch` function is making an asynchronous request to the specified URL
 * with the given parameters.
 */
async function getData(data, method, url) {
  var parameters;
  //Show Preload 
  mainApp.showPreload();
  if (method == "GET") {
    parameters = {
      method: method,
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    }
  } else {
    parameters = {
      method: method,
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    }
  }
  return await fetch(url, parameters);
}


/* The `$(document).ready(function () { ... });` code snippet is utilizing jQuery to ensure that the
specified functions are executed once the document (HTML) has been fully loaded. Within this
function: */
$(document).ready(function () {
  $('#' + tableId).DataTable();
  $('#' + tableModuleId).DataTable();
  $('#' + tablePermissionsId).DataTable();
});

/**
 * The function `reloadPage` hides a preload element, waits for 500 milliseconds, and then reloads the
 * page.
 */
function reloadPage() {
  setTimeout(function () {
    //hidden Preload 
    mainApp.hiddenPreload();
    location.reload();
  }, 500);
}


