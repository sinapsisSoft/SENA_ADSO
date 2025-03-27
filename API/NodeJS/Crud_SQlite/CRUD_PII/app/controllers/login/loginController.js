
/* Author:DIEGO CASALLAS
* Date:25/03/2025
* Descriptions:This is controller back-end Login , access to the system
* **/
/* The code snippet `const formId = ['my-form', 'my-form-changes-password']; const modalId =
'my-modal'; const preloadId = 'preloadId'; const classEdit = 'edit-input'; const textConfirm =
'Press a button!\nEither OK or Cancel.'; const mainApp = new Main(modalId, formId, classEdit,
preloadId);` is initializing several constants and creating a new instance of the `Main` class. */
const formId = ['my-form', 'my-form-changes-password'];
const modalId = 'my-modal';
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const mainApp = new Main(modalId, formId, classEdit, preloadId);


/* The lines `const objFormLogin = mainApp.getForm(0);` and `const objFormLoginChanges =
mainApp.getForm(1);` are retrieving form elements from the DOM using the `Main` class instance
`mainApp`. */
const objFormLogin = mainApp.getForm(0);
const objFormLoginChanges = mainApp.getForm(1);

/* The variables `url`, `method`, `data`, and `resultFetch` are being declared and initialized in the
JavaScript code snippet provided. Here is what each variable is intended for: */
var url = "";
var method = "";
var data = "";
var resultFetch = null;

/**
 * The `add` function enables a form, resets it, hides error messages, and shows a modal.
 */
function add() {
  mainApp.enableFormAll(1);
  mainApp.resetForm(1);
  mainApp.hiddenMessageError();
  mainApp.showModal();
}
/* The `objFormLogin.addEventListener('submit', function (e) { ... })` code block is an event listener
attached to the form with the ID `my-form`. It listens for the form submission event and executes
the provided function when the form is submitted. */
objFormLogin.addEventListener('submit', function (e) {
  e.preventDefault();
  if (mainApp.setValidateForm(0)) {
    data = mainApp.getDataFormJson(0);
    method = 'POST';
    url = URL + URI_LOGIN;
    resultFetch = getData(data, method, url);
    resultFetch.then(response => {
      return response.json();
    }).then(data => {
      console.log(data);
      if (data.status == 200) {
        mainApp.hiddenMessageError();
        mainApp.resetForm(0);
        mainApp.setLocationPage('../home/home_view.html')
      }
    }).catch(error => {
      mainApp.hiddenMessageError();
    }).finally(() => {
      mainApp.hiddenPreload();
      mainApp.hiddenMessageError();
    });
    mainApp.resetForm(0);
  }
});

/* The `objFormLoginChanges.addEventListener('submit', function (e) { ... })` code block is an event
listener attached to the form with the ID `my-form-changes-password`. It listens for the form
submission event and executes the provided function when the form is submitted. */
objFormLoginChanges.addEventListener('submit', function (e) {
  e.preventDefault();
  if (mainApp.setValidateForm(1)) {
    data = mainApp.getDataFormJson(1);
    method = 'PUT';
    url = URL + URI_LOGIN;
    resultFetch = getData(data, method, url);
    resultFetch.then(response => {
      return response.json();
    }).then(data => {
      console.log(data);
      if (data.status == 200) {
        mainApp.hiddenMessageError();
        mainApp.resetForm(1);
        mainApp.hiddenPreload();
      }
    }).catch(error => {
      mainApp.hiddenMessageError();
    }).finally(() => {
      mainApp.hiddenPreload();
      mainApp.hiddenMessageError();
      mainApp.hiddenModal();
    });

  }
});
/**
 * The function `getData` is an asynchronous function in JavaScript that sends a request to a specified
 * URL using the specified method and data.
 * @param data - The `data` parameter in the `getData` function represents the data that you want to
 * send in the request. It could be an object containing the information you want to send to the
 * server. If the request method is "GET", this data would typically be appended to the URL as query
 * parameters.
 * @param method - The `method` parameter in the `getData` function determines the HTTP method to be
 * used for the request. It can be either "GET" or another HTTP method like "POST", "PUT", "DELETE",
 * etc.
 * @param url - The `url` parameter in the `getData` function is the URL to which the HTTP request will
 * be sent. It specifies the location of the resource on the web server that the function will interact
 * with.
 * @returns The `getData` function is returning the result of the `fetch` function with the specified
 * `url` and `parameters`. The `fetch` function performs an asynchronous request to the specified `url`
 * using the provided `parameters` which include the HTTP method, headers, and data (if applicable).
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
