"use strict";


/* Author:DIEGO CASALLAS
* Date:29/05/2024
* Descriptions:This is controller Curse 
* **/

/* These lines of code are declaring constants and initializing variables in a JavaScript file. Here is
a breakdown of what each line is doing: */
const formId = ['my-form', 'student-form', 'management-form', 'instructor-form'];
const modalId = ['my-modal', 'students-modal', 'instructor-modal'];
const model = 'programGroups';
const tableId = ['table-index', 'table-group-students', 'table-no-group-students', 'table-index-management', 'table-group-instructor', 'table-no-group-instructor'];
const preloadId = 'preloadId';
const classEdit = 'edit-input';
const textConfirm = 'Press a button!\nEither OK or Cancel.';
const btnActions = ['btn_form', 'btn_student_form', 'btn_management_form', 'btn_instructor_form'];
const mainApp = new Main(modalId, formId, classEdit, preloadId);

/* These lines of code are declaring and initializing variables in a JavaScript file. Here is a
breakdown of what each variable is used for: */
var insertUpdate = true;
var url = "";
var method = "";
var data = "";
var resultFetch = null;
var getKeyModule = { 'group_id': 0, 'student_id': 0, 'instructor_id': 0 };

/**
 * The function `showStatus` disables all form elements, resets the form, enables a button, and
 * retrieves the status based on the provided ID.
 * @param id - The `id` parameter is used to identify a specific status that needs to be displayed.
 */
function show(id) {
  mainApp.disabledFormAll();
  mainApp.resetForm();
  mainApp.btnEnabledDisabled(true, btnActions[0]);
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
  mainApp.btnEnabledDisabled(false, btnActions[0]);
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
  mainApp.btnEnabledDisabled(false, btnActions[0]);
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
  url = URI_PROGRAMS_GROUPS + LIST_CRUD[3] + '/' + id;
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
      })
      .finally(() => {
        //hidden Preload 
        mainApp.hiddenPreload();
      });
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
  url = URI_PROGRAMS_GROUPS + LIST_CRUD[1] + '/' + id;
  data = mainApp.getDataFormJson();
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data);
      ///Set data form 
      mainApp.setDataFormJson(data[model]);
      //show Modal 
      mainApp.showModal();
    })
    .catch(error => {
      console.error(error);
    })
    .finally(() => {
      //hidden Preload 
      mainApp.hiddenPreload();
    });
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
      url = URI_PROGRAMS_GROUPS + LIST_CRUD[0];
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
        })
        .finally(() => {
          //hidden Preload 
          mainApp.hiddenPreload();
        });
    } else {
      method = 'POST';
      url = URI_PROGRAMS_GROUPS + LIST_CRUD[2];
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
        })
        .finally(() => {
          //hidden Preload 
          mainApp.hiddenPreload();
        });
    }
  } else {
    alert("Data Validate");
    mainApp.resetForm();
  }
});

/**
 * The function `show_student` sets certain elements as disabled, resets a form, enables a button,
 * assigns a value to a key, and calls another function.
 * @param id - The `id` parameter in the `show_student` function is used to identify a specific student
 * or group of students. It is passed as an argument to the function and is then used to perform
 * various actions such as disabling form editing, resetting the form, enabling a button, and setting a
 * key module
 */
async function show_student(id) {
  mainApp.btnEnabledDisabled(true, btnActions[1]);
  getKeyModule['group_id'] = id;
  getStudentsGroups(id);
}

async function getStudentsGroups(id) {
  method = 'GET';
  url = URI_PROGRAMS_STUDENT_GROUPS + LIST_CRUD[4] + '/' + id;
  data = "";
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data[model]);
      let arrayColumn = ['#', 'Document', 'First Name', 'Last Name'];
      let arrayActions = [
        {
          name: 'remove_student_group',
          label: 'Remove to Group',
          icon: 'bi-person-dash',
          type: 'danger'
        }

      ];
      getStudentsNoGroups().then(() => {
        mainApp.createTable('table-group-students', arrayColumn, data[model], true, arrayActions);
      });
    })
    .catch(error => {
      console.error(error);
    })
    .finally(() => {
      //hidden Preload 
      mainApp.hiddenPreload();
    });
}

async function getStudentsNoGroups() {
  method = 'GET';
  url = URI_PROGRAMS_STUDENT_GROUPS + LIST_CRUD[4];
  data = "";
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data[model]);
      let arrayColumn = ['#', 'Document', 'First Name', 'Last Name'];
      let arrayActions = [
        {
          name: 'add_student_group',
          label: 'Add to Group',
          icon: 'bi-person-plus-fill',
          type: 'primary'
        }

      ];
      mainApp.createTable('table-no-group-students', arrayColumn, data[model], true, arrayActions);
      mainApp.showModal(1);
    })
    .catch(error => {
      console.error(error);
    })
    .finally(() => {
      //hidden Preload 
      mainApp.hiddenPreload();
    });
}

/**
 * The function `add_student_group` adds a student to a group after confirming the action and making a
 * POST request to a specified URL.
 * @param id - The `id` parameter in the `add_student_group` function is used to specify the student ID
 * that will be added to a student group.
 */
async function add_student_group(id) {
  getKeyModule['student_id'] = id;
  if (confirm(textConfirm) == true) {
    method = 'POST';
    url = URI_PROGRAMS_STUDENT_GROUPS + LIST_CRUD[0];
    data = getKeyModule;
    //console.log(data);
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        //Create table
        getStudentsGroups(getKeyModule['group_id']);
      })
      .catch(error => {
        console.error(error);
      })
      .finally(() => {
        //hidden Preload 
        mainApp.hiddenPreload();
      });
  } else {

  }
}

function show_management(id) {
  mainApp.showPreload();
  setTimeout(() => {
    window.location.href = URI_MANAGEMENT_GROUPS + LIST_CRUD[4] + '/' + id;
  }, 1000);

}

async function show_instructor(id) {
  mainApp.btnEnabledDisabled(true, btnActions[3]);
  getKeyModule['group_id'] = id;
  getInstructorsGroups(id);

}

async function getInstructorsGroups(id) {
  method = 'GET';
  url = URI_PROGRAMS_INSTRUCTOR_GROUPS + LIST_CRUD[4] + '/' + id;
  data = "";
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      console.log(data[model]);
      let arrayColumn = ['#', 'Document', 'First Name', 'Last Name', 'Specialty'];
      let arrayActions = [
        {
          name: 'remove_instructor_group',
          label: 'Remove to Group',
          icon: 'bi-person-dash',
          type: 'danger'
        }
      ];
      getInstructorNoGroups().then(() => {
        mainApp.createTable('table-group-instructor', arrayColumn, data[model], true, arrayActions);
        mainApp.showModal(2);
      });
    })
    .catch(error => {
      console.error(error.messages);
    })
    .finally(() => {
      //hidden Preload 
      mainApp.hiddenPreload();
    });
}
async function getInstructorNoGroups() {
  method = 'GET';
  url = URI_PROGRAMS_INSTRUCTOR_GROUPS + LIST_CRUD[4];
  data = "";
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      console.log(data[model]);
      let arrayColumn = ['#', 'Document', 'First Name', 'Last Name', 'Specialty'];
      let arrayActions = [
        {
          name: 'add_instructor_group',
          label: 'Add to Group',
          icon: 'bi-person-plus-fill',
          type: 'primary'
        }

      ];
      mainApp.createTable('table-no-group-instructor', arrayColumn, data[model], true, arrayActions);
      mainApp.showModal(2);
    })
    .catch(error => {
      console.error(error);

    })
    .finally(() => {
      //hidden Preload 
      mainApp.hiddenPreload();
    });
}

async function remove_instructor_group(id) {

  if (confirm(textConfirm) == true) {
    method = 'DELETE';
    url = URI_PROGRAMS_INSTRUCTOR_GROUPS + LIST_CRUD[3] + '/' + id;
    data = getKeyModule;
    //console.log(data);
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        //Create table
        //console.log(data);
      })
      .catch(error => {
        console.error(error);
      })
      .finally(() => {
        //hidden Preload 
        mainApp.hiddenPreload();
      });
  } else {

  }
}
async function remove_student_group(id) {
  if (confirm(textConfirm) == true) {
    method = 'DELETE';
    url = URI_PROGRAMS_STUDENT_GROUPS + LIST_CRUD[3] + '/' + id;
    data = getKeyModule;
    //console.log(data);
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        //Create table
        //console.log(data);
        getStudentsGroups(getKeyModule['group_id']);
      })
      .catch(error => {
        console.error(error);
      })
      .finally(() => {
        //hidden Preload 
        mainApp.hiddenPreload();
      });
  } else {

  }
}

async function add_instructor_group(id) {
  getKeyModule['instructor_id'] = id;
  if (confirm(textConfirm) == true) {
    method = 'POST';
    url = URI_PROGRAMS_INSTRUCTOR_GROUPS + LIST_CRUD[0];
    data = getKeyModule;
    //console.log(data);
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        //Create table
        //console.log(data);
      })
      .catch(error => {
        console.error(error);
      })
      .finally(() => {
        //hidden Preload 
        mainApp.hiddenPreload();
      });
  } else {

  }
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

window.onload = function () {
  console.log("program Groups  loaded");
  // Initialize the programGroups
  mainApp.showPreload();
  mainApp.refreshTable(tableId[0]);
  setTimeout(() => {
    mainApp.hiddenPreload();
  }, 1000);
}