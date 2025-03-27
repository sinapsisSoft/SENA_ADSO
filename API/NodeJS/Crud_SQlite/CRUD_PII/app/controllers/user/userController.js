/* Author:DIEGO CASALLAS
* Date:20/03/2025
* Descriptions:This is controller User 
* **/

/* The provided code snippet is declaring and initializing several constants and variables in a
JavaScript file. Here is a breakdown of what each of them is doing: */
const formId = 'my-form';
const modalId = 'my-modal';
const model = 'users';
const tableId = '#table-index';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const btnSubmit = document.getElementById('btnSubmit');
const mainApp = new Main(modalId, formId, classEdit, preloadId);
const roleSelectId="role";
const myId="User_id";
/* These lines of code are declaring and initializing variables in a JavaScript file. Here is a
breakdown of what each variable is used for: */
var insertUpdate = true;
var url = "";
var method = "";
var data = "";
var resultFetch = null;


/* The `window.addEventListener('load', (event) => { show(); });` code snippet is adding an event
listener to the `load` event of the `window` object. When the window has finished loading (i.e.,
when all resources on the page have been loaded), the `show()` function is called. This ensures that
the `show()` function is executed once the entire page has loaded, allowing any necessary
initialization or data retrieval operations to be performed at that time. */
window.addEventListener('load', (event) => {
  show();
});

/**
 * The function `showStatus` disables all form elements, resets the form, enables a button, and
 * retrieves the status based on the provided ID.
 * @param id - The `id` parameter is used to identify a specific status that needs to be displayed.
 */
function showId(id) {
  mainApp.disabledFormAll();
  mainApp.resetForm();
  btnEnabled(true);
  getDataId(id);
}


/**
 * The function "show" calls the "getUsers" and "getRoles" functions.
 */
function show() {
  getUsers();
  getRoles();
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
  if (confirm(textConfirm) == true) {
    method = 'DELETE';
    url = URL + URI_USER + id;
    data = "";
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        console.log(data);
        ///Set data form 
        reloadPage();
        mainApp.hiddenPreload();
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
  url = URL + URI_USER + id;
  data = "";
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      // console.log(data);
      ///Set data form 
      mainApp.setDataFormJson(data);
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
 * The function `getUsers` makes an asynchronous request to fetch user data, creates a table with the
 * data, and then refreshes the table while handling errors and hiding a preload element.
 */
async function getUsers() {
  method = 'GET';
  url = URL + URI_USER;
  data = mainApp.getDataFormJson();
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data);
      ///create table
      mainApp.createTable(data, "tbody", true);
      refreshTable();
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .catch(err => {
      //console.error(err);
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .finally();
}

/**
 * The function `getRoles` makes a GET request to a specified URL to fetch roles data, creates a select
 * element based on the data, and then hides a preload element.
 */
async function getRoles() {
  method = 'GET';
  url = URL + URI_ROLE;
  data = mainApp.getDataFormJson();
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data);
      ///create select
      mainApp.createSelect(data,roleSelectId);
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .catch(err => {
      //console.error(err);
      //hidden Preload 
      mainApp.hiddenPreload();
    })
    .finally();
}

/**
 * The function refreshTable() initializes a DataTable for a specified table element using jQuery.
 */
function refreshTable() {
  $(tableId).DataTable();
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
 * The function `getData` is an asynchronous function that makes a fetch request with specified data,
 * method, and URL while showing a preload indicator.
 * @param data - The `data` parameter in the `getData` function represents the data that you want to
 * send in the request. It could be an object containing the information you want to send to the
 * server, such as user input or any other relevant data needed for the request.
 * @param method - The `method` parameter in the `getData` function specifies the HTTP request method
 * to be used for fetching data. It can be either "GET" or another HTTP method like "POST", "PUT",
 * "DELETE", etc., depending on the type of request you want to make to the specified URL
 * @param url - The `url` parameter in the `getData` function is the URL to which the HTTP request will
 * be sent. It specifies the location of the resource that the function will interact with.
 * @returns The function `getData` is returning the result of the `fetch` function called with the
 * provided `url` and `parameters`. The `fetch` function performs an asynchronous request to the
 * specified `url` using the given `parameters` and returns a Promise that resolves to the Response to
 * that request.
 */
async function getData(data, method, url) {
  var parameters;
  //Show Preload 
  mainApp.showPreload();
  if (method == "GET") {
    parameters = {
      method: method,
      mode: 'cors',
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    }
  } else {
    parameters = {
      method: method,
      mode: 'cors',
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    }
    if (data != "") {
      parameters.body = JSON.stringify(data);
    }
  }
  return await fetch(url, parameters);
}



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
      url = URL + URI_USER;
      data = mainApp.getDataFormJson();
      //console.log(data);
      resultFetch = getData(data, method, url);
      resultFetch.then(response => response.json())
        .then(data => {
          console.log(data);
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
      method = 'PUT';
      data = mainApp.getDataFormJson();
      url = URL + URI_USER + data[myId];
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