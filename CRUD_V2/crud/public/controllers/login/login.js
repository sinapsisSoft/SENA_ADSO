/* Author:DIEGO CASALLAS
* Date:22/05/2024
* Descriptions:This is controller Login
* **/

/* The code snippet you provided is setting up various constants and initializing the `mainApp` object
with specific parameters. Here is a breakdown of what each line is doing: */
const formId = ['my-form', 'my-form-login'];
const alertId = ['my-alert'];
const modalId = 'my-modal';
const model = 'roleModules';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const mainApp = new Main(modalId, formId, classEdit, preloadId);
const mainAlert = new Alert(alertId);

/* The variables `insertUpdate`, `url`, `method`, `data`, and `resultFetch` are being initialized in
the provided code snippet. Here is a breakdown of what each variable is intended for: */
var url = "";
var method = "";
var data = "";
var resultFetch = null;

/**
 * The `add` function resets a form, enables all form elements, sets a flag to insert or update data,
 * disables a button, and shows a modal.
 */
function showForget() {
  mainApp.resetForm();
  mainApp.enableFormAll();
  mainApp.showModal();
}


mainApp.getForm().addEventListener('submit', async function (event) {
  event.preventDefault();
  if (mainApp.setValidateForm()) {
    //Show Preload 
    mainApp.showPreload();
    method = 'POST';
    url = URI_LOGIN + 'forgerPassword';
    data = mainApp.getDataFormJson();
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        //console.log(data);
        if (data['response'] == 200) {
          alert("Send message change password");
        } else {
          alert("Error Send message change password");
        }
        //show Modal 
        mainApp.hiddenModal();
        mainApp.hiddenPreload();
      })
      .catch(error => {
        console.error(error);
        //hidden Preload 
        mainApp.hiddenPreload();
      })
      .finally();

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
  if (mainApp.setValidateForm(1)) {
    //Show Preload 
    mainApp.showPreload();
    method = 'POST';
    url = URI_LOGIN + 'logIn';
    data = mainApp.getDataFormJson(1);
    //console.log(data);
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        // console.log(data);
        if (data['response'] == 200) {
          alert("Ok: " + data['message']);
          location.assign('/dashboard');
        } else {
          alert("Error: " + data['message']);
          mainApp.hiddenPreload();
        }
      })
      .catch(error => {
        console.error(error);
        //hidden Preload 
        mainApp.hiddenPreload();
      })
      .finally();
  } else {
    alert("Data Validate");
    mainApp.resetForm(1);
  }
});

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


