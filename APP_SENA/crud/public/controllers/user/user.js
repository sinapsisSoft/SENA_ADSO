/* Author:DIEGO CASALLAS
* Date:17/05/2024
* Descriptions:This is controller User 
* **/

/* These lines of code are declaring constants and initializing variables in a JavaScript file. Here is
a breakdown of what each line is doing: */
const formId = 'my-form';
const modalId = 'my-modal';
const model = 'users';
const tableId = 'table-index';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const btnSubmit = document.getElementById('btnSubmit');
const mainApp = new Main(modalId, formId, classEdit, preloadId);

/* These lines of code are declaring and initializing variables in a JavaScript file. Here is a
breakdown of what each variable is used for: */
var insertUpdate = true;
var url = "";
var method = "";
var data = "";
var resultFetch = null;

/**
 * The function `showStatus` disables all form elements, resets the form, enables a button, and
 * retrieves the status based on the provided ID.
 * @param id - The `id` parameter is used to identify a specific status that needs to be displayed.
 */
function show(id) {
  mainApp.disabledFormAll();
  mainApp.resetForm();
  btnEnabled(true);
  getDataId(id);
}

/**
 * The function `newStatus` enables a form, resets it, sets a flag, disables a button, and shows a
 * modal.
 */
function add() {
  mainApp.enableFormAll();
  mainApp.resetForm();
  insertUpdate = true;
  btnEnabled(false);
  mainApp.showModal();
}

/**
 * The function `editStatus` disables form editing, resets the form, sets `insertUpdate` to false,
 * disables a button, and retrieves the status ID.
 * @param id - The `id` parameter in the `editStatus` function is used to identify the specific status
 * that needs to be edited.
 */
function edit(id) {
  mainApp.disabledFormEdit();
  mainApp.resetForm();
  insertUpdate = false;
  btnEnabled(false);
  getDataId(id);
}

/**
 * The function `deleteStatus` is an asynchronous function that sends a GET request to delete a status
 * based on the provided ID, with a confirmation prompt and subsequent data retrieval and page reload.
 * @param id - The `id` parameter in the `deleteStatus` function represents the unique identifier of
 * the status that you want to delete. This identifier is used to specify which status entry should be
 * deleted from the system.
 */
async function delete_(id) {
  method = 'GET';
  url = URI_USER + LIST_CRUD[3] + '/' + id;
  data = "";
  if (confirm(textConfirm) == true) {
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        //console.log(data);
         //Reload View
         reloadPage();
      })
      .catch(error => {
        console.error(error);
        //hidden Preload 
        mainApp.hiddenPreload();
      })
      .finally();
  } else {
  }
}

/**
 * The function `getDataId` makes an asynchronous GET request to retrieve data based on an ID, then
 * processes the response data to update the form, show a modal, and handle errors.
 * @param id - The `id` parameter in the `getDataId` function is used to specify the ID of the status
 * you want to retrieve.
 */
async function getDataId(id) {
  method = 'GET';
  url = URI_USER + LIST_CRUD[1] + '/' + id;
  data = mainApp.getDataFormJson();
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data);
      ///Set data form 
      mainApp.setDataFormJson(data[model]);
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

/* The code `$(document).ready(function () { $('#' + tableId).DataTable(); });` is using jQuery to
initialize a DataTable on a specific HTML table element identified by the `tableId` variable. */
$(document).ready(function () {
  $('#' + tableId).DataTable();
});

/* The code snippet you provided is an event listener attached to the form element within the `mainApp`
object. It listens for the `submit` event on the form and executes a series of actions when the form
is submitted. Here is a breakdown of what the code is doing: */
mainApp.getForm().addEventListener('submit', async function (event) {
  event.preventDefault();
  if (mainApp.setValidateForm()) {
    //Show Preload 
    mainApp.showPreload();
    if (insertUpdate) {
      method = 'POST';
      url = URI_USER + LIST_CRUD[0];
      data = mainApp.getDataFormJson();
      console.log(data);
      resultFetch = getData(data, method, url);
      resultFetch.then(response => response.json())
        .then(data => {
          //console.log(data);
          //show Modal 
          mainApp.hiddenModal();
          //Reload View
          reloadPage();
        })
        .catch(error => {
          console.error(error);
          //hidden Preload 
          mainApp.hiddenPreload();
        })
        .finally();
    } else {
      method = 'POST';
      url = URI_USER + LIST_CRUD[2];
      data = mainApp.getDataFormJson();
      //console.log(data);
      resultFetch = getData(data, method, url);
      resultFetch.then(response => response.json())
        .then(data => {
          //console.log(data);
          //show Modal 
          mainApp.hiddenModal();
          //Reload View
          reloadPage();
        })
        .catch(error => {
          console.error(error);
          //hidden Preload 
          mainApp.hiddenPreload();
        })
        .finally();
    }
  } else {
    alert("Data Validate");
    mainApp.resetForm();
  }
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

