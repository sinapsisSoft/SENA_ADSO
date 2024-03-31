/**
* Author:DIEGO CASALLAS
* Date:31/03/2024
* Descripction: This feature is for user management from Firebase
*/

const icons = new Array("./assets/img/icons/eye-fill.svg", "./assets/img/icons/eye-slash-fill.svg");

/**
 * The function `viewText` toggles the visibility of a password input field and updates the
 * corresponding icon accordingly.
 * @param id - The `id` parameter is the unique identifier of the HTML element that you want to toggle
 * between displaying as a password field and a plain text field.
 */
export function viewText(id) {
  let objInput = document.getElementById(id);
  let typeInput = "password";
  let iconsInput = icons[1];
  if (objInput.type == "password") {
    typeInput = "text";
    iconsInput = icons[0];
  } else {
    typeInput = "password";
    iconsInput = icons[1];
  }
  objInput.type = typeInput;
  objInput.nextElementSibling.childNodes[0].src = iconsInput;
}

/**
 * The function `sendData` takes the form element with the specified ID, retrieves the form data, logs
 * it to the console, and prevents the default form submission behavior.
 * @param idForm - The `idForm` parameter is the ID of the form element in the HTML document that you
 * want to retrieve data from.
 * @param e - The `e` parameter in the `sendData` function is typically an event object that represents
 * the event that triggered the function. In this case, it is likely used to prevent the default
 * behavior of a form submission using `e.preventDefault()`. This is a common practice in JavaScript to
 * prevent the default
 */
export function sendData(idForm) {
  let objForm = document.getElementById(idForm);
  return getDataForm(objForm);
}

/**
 * The function `getDataForm` is designed to extract form data, validate passwords, and return a JSON
 * object containing the form field IDs and values.
 * @param objForm - The `objForm` parameter in the `getDataForm` function is expected to be a reference
 * to a form element in the HTML document. This function is designed to extract data from the form
 * inputs and return it as a JSON object.
 * @returns The function `getDataForm` is returning a JSON object containing the data entered in the
 * form fields.
 */
export function getDataForm(objForm) {
  try {
    var elementsForm = objForm.querySelectorAll('input');
    let arrayPasswords = [];
    let json = {};
    let key;
    let value;
    for (let i = 0; i < elementsForm.length; i++) {
      var elem = elementsForm[i];
      if (elem.value == "" || elem.length == 0) {
        alert("Validate the data entered");
        return false;
      }
      if (elem.dataset.type == "password") {
        if (arrayPasswords.length == 0) {
          arrayPasswords[0] = elem;
        } else {
          arrayPasswords[1] = elem;
        }
        if (arrayPasswords.length == 2) {
          if (!(arrayPasswords[0].value == arrayPasswords[1].value)) {
            alert("Passwords are not valid");
            cleanInputPassword(objForm,arrayPasswords);
            arrayPasswords = [];
           
            return false;
          } else {
            key = arrayPasswords[0].id;
            value = arrayPasswords[0].value;
            arrayPasswords = [];
            json[key] = value;
          }
        } else {
          key = elem.id;
          value = elem.value;
          json[key] = value;
        }
      } else {
        key = elem.id;
        value = elem.value;
        json[key] = value;
      }
    }
    return json;
  } catch (error) {
    console.error(error);
  }
}

/**
 * The `cleanForm` function resets a given form element.
 * @param objForm - The `objForm` parameter in the `cleanForm` function is expected to be a reference
 * to a form element in the HTML document. This function is designed to reset the form fields to their
 * default values.
 */
export function cleanForm(objForm) {
  objForm.reset();
}
/**
 * The function cleanInputPassword resets a form and changes specified input fields to password type.
 * @param objForm - The `objForm` parameter in the `cleanInputPassword` function is likely a reference
 * to a form element in the HTML document. This parameter is used to reset the form after cleaning the
 * input fields.
 * @param ArrayInputs - ArrayInputs is an array containing input elements that need to be cleaned. The
 * function `cleanInputPassword` sets the type of each input element in the array to "password" and
 * updates the next sibling element's child node with a specific icon. Finally, it resets the form
 * specified by `objForm
 */
export function cleanInputPassword(objForm,ArrayInputs) {
  for(let input of ArrayInputs){
    input.type="password";
    input.nextElementSibling.childNodes[0].src = icons[1];
  }
  objForm.reset();
}
