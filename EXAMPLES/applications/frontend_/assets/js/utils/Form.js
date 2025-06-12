/**
 * Author:Diego Casallas
 * Description:
 * Date:05/06/2025
 * File:
 */
class Form {

  /**
   * The constructor function initializes an object with references to a form element and a specified
   * class for editable inputs.
   * @param idForm - The `idForm` parameter is the ID of the form element in the HTML document that you
   * want to target with this constructor.
   * @param classEditInput - The `classEditInput` parameter is a class name that will be used to
   * identify the input elements within the form that you want to make editable. This class name will
   * be applied to the input elements that you want to target for editing within the specified form.
   */
  constructor(idForm, classEditInput) {
    this.objForm = document.getElementById(idForm);
    this.classEdit = classEditInput;
  }
  /**
   * The `getForm` function returns the `objForm` property of the current object.
   * @returns The `objForm` property is being returned.
   */
  getForm() {
    return this.objForm;
  }
  /* The `validateForm()` function is responsible for validating the form inputs. It first selects all
  input and textarea elements within the form using `objForm.querySelectorAll('input')` and
  `objForm.querySelectorAll('textarea')`. */
  validateForm() {
    let elementInput = this.objForm.querySelectorAll('input');
    let elementTextarea = this.objForm.querySelectorAll('textarea');
    
    let validate = true;
    for (let i = 0; i < elementInput.length; i++) {
    
      if (!this.validateInputs(elementInput[i])) {
       
        validate = false;
        break;
      }
    }
    if (validate) {
      for (let j = 0; j < elementTextarea.length; j++) {
        if (!this.validateTextarea(elementTextarea[j])) {
          validate = false;
          break;
        }
      }
    }
    return validate;
  };

  /* The `validateTextarea(objTextarea)` function is checking the value of a textarea element to ensure
  it meets certain criteria. It first retrieves the value of the textarea element using
  `objTextarea.value`. Then, it checks if the value is an empty string, consists only of whitespace
  characters, or has a length less than 3 characters. If any of these conditions are met, the
  function returns `false` indicating that the textarea input is not valid. Otherwise, it returns
  `true`, indicating that the textarea input is valid. */
  validateTextarea(objTextarea) {
    let getValue = objTextarea.value;
    if (getValue === "" || getValue.trim === "" || getValue.length < 3) {
      return false;
    }
    return true;
  };

  /* The `validateInputs(objInput)` function is a method within the `Form` class that takes an input
  element as a parameter and checks its type. If the input type is "text", it calls the
  `validateText(objInput)` function to validate the text input. If the input type is "number", it
  calls the `validateNumber(objInput)` function to validate the number input. This function is used
  to validate different types of input fields based on their type attribute. */
  validateInputs(objInput) {
    let message = objInput.dataset.message;
    let type = objInput.dataset.type;
    let min = objInput.dataset.min;
    let max = objInput.dataset.max;
    let regex = objInput.dataset.regex;

    //console.table(message, type, min, max, regex);

    switch (objInput.type) {
      case "text":
        return this.validateText(objInput);
        break;
        case "password":
        return this.validatePassword(objInput);
        break;
      case "number":
        return this.validateNumber(objInput);
        break;
         case "checkbox":
        return this.validateCheckbox(objInput);
        break;
    }
  };

  /**
   * The function `validateText` checks if the input value is not empty, not just whitespace, and has a
   * length of at least 2 characters.
   * @param objInput - objInput is an object that represents an input element in a form.
   * @returns The `validateText` function is returning a boolean value. It returns `true` if the input
   * value is not empty, not just whitespace, and has a length of at least 2 characters. Otherwise, it
   * returns `false`.
   */
  validateText(objInput) {
    let getValue = objInput.value;
   // console.log(getValue);
    if (getValue === "" || getValue.trim === "" || getValue.length < 2) {
      return false;
    }
    return true;
  }
    validateCheckbox(objInput) {
    let getValue = objInput.checked;

    if (getValue) {
      return false;
    }
    return true;
  }
    validatePassword(objInput) {
    let getValue = objInput.value;
    //console.log(getValue);
    if (getValue === "" || getValue.trim === "" || getValue.length < 2) {
      return false;
    }
    return true;
  }

  /**
   * The function `validateNumber` checks if the input value is a valid number in JavaScript.
   * @param objInput - objInput is an object that represents an input element in a form.
   * @returns The function `validateNumber` will return `false` if the input value is not a number, is an
   * empty string, or is a string with only whitespace characters. Otherwise, it will return `true`.
   */
  validateNumber(objInput) {
    let getValue = objInput.value;
    if (isNaN(getValue) || getValue === "" || getValue.trim === "") {
      return false;
    }
    return true;
  }

  /**
   * The function `getDataFormData` retrieves form data from input, select, and textarea elements and
   * returns it as a FormData object.
   * @returns The `getDataFormData()` function returns a FormData object containing the data from the
   * form elements (input, select, textarea) that have an id attribute. The function iterates over the
   * form elements, checks their type (checkbox, select, textarea), and appends the element's id and
   * value (trimmed) to the FormData object.
   */
  getDataFormData() {
    var elementsForm = this.objForm.querySelectorAll('input, select, textarea');
    let fromData = new FormData();
    elementsForm.forEach(function (element) {
      if (element.id) {
        if (element.tagName === 'INPUT') {
          if (element.type === 'checkbox') {
            fromData.append(element.id, element.checked);
          } else {
            fromData.append(element.id, element.value.trim());
          }
        } else if (element.tagName === 'SELECT') {
          fromData.append(element.id, element.value.trim());
        }
        else if (element.tagName === 'TEXTAREA') {
          fromData.append(element.id, element.value.trim());
        }
      }
    });
    return fromData;
  }

  /**
   * The function `setDataFormJson` populates form input fields with values from a JSON object based on
   * matching keys.
   * @param json - The `json` parameter in the `setDataFormJson` function is an object that contains
   * key-value pairs representing data that needs to be set in a form. The keys in the `json` object
   * correspond to the `id` attributes of form elements, and the values represent the data that should be
   */
  setDataFormJson(json) {
    let elements = this.objForm.querySelectorAll("input,select,textarea");
    let jsonKeys = Object.keys(json);
    for (let i = 0; i < elements.length; i++) {
      if (elements[i].type == "checkbox") {
        if (jsonKeys.includes(elements[i].id)) {
          elements[i].checked = (json[elements[i].id] == 0) ? false : true;
        }
      } else if (elements[i].tagName === 'SELECT') {
        if (jsonKeys.includes(elements[i].id)) {
          elements[i].value = json[elements[i].id];
          elements[i].selected = true;
        }

      } else if (elements[i].tagName === 'TEXTAREA') {
        if (jsonKeys.includes(elements[i].id)) {
          elements[i].value = json[elements[i].id];
        }
      } else {
        if (jsonKeys.includes(elements[i].id)) {
          elements[i].value = json[elements[i].id];
        }
      }
    }
  }

  /**
   * The function `getDataForm` retrieves data from form elements and returns it as a JSON object.
   * @returns The `getDataForm()` function returns an object containing the data from the form elements
   * with IDs in the form. The data is collected based on the element type (input, select, textarea) and
   * stored in the object with the element ID as the key and the trimmed value as the value. If the
   * element is a checkbox, the value stored is the checked status.
   */
  getDataForm() {
    var elementsForm = this.objForm.querySelectorAll('input, select, textarea');
    let getJson = {};
    elementsForm.forEach(function (element) {
      if (element.id) {
        if (element.tagName === 'INPUT') {
          if (element.type === 'checkbox') {
            getJson[element.id] = element.checked;
          } else {
            getJson[element.id] = element.value.trim();
          }
        } else if (element.tagName === 'SELECT') {
          getJson[element.id] = element.value.trim();
        } else if (element.tagName === 'TEXTAREA') {
          getJson[element.id] = element.value.trim();
        }
      }
    });
    return getJson;
  }

  /**
   * The `resetForm` function clears the values of input fields and textareas within a specified form.
   */
  resetForm() {
    let elementInput = this.objForm.querySelectorAll('input');
    let elementTextarea = this.objForm.querySelectorAll('textarea');
    for (let i = 0; i < elementInput.length; i++) {
      elementInput[i].value = "";
    }
    for (let j = 0; j < elementTextarea.length; j++) {
      elementTextarea[j].value = "";
    }
    this.objForm.reset();
  }

  /**
   * The `disabledForm` function disables all input fields and textareas within a specified form and resets the form.
   */
  disabledForm() {
    let elementInput = this.objForm.querySelectorAll('input');
    let elementTextarea = this.objForm.querySelectorAll('textarea');
    for (let i = 0; i < elementInput.length; i++) {
      elementInput[i].disabled = true;
    }
    for (let j = 0; j < elementTextarea.length; j++) {
      elementTextarea[j].disabled = true;
    }
    this.objForm.reset();
  }

  /**
   * The `enabledForm` function enables all input fields and textareas within a specified form and resets the form.
   */
  enabledForm() {
    let elementInput = this.objForm.querySelectorAll('input');
    let elementTextarea = this.objForm.querySelectorAll('textarea');
    for (let i = 0; i < elementInput.length; i++) {
      elementInput[i].disabled = false;
    }
    for (let j = 0; j < elementTextarea.length; j++) {
      elementTextarea[j].disabled = false;
    }
    this.objForm.reset();
  }

  /**
   * The function `enabledEditForm` enables or disables form input elements based on their class names.
   */
  enabledEditForm() {
    let elementInput = this.objForm.querySelectorAll('input');
    let elementTextarea = this.objForm.querySelectorAll('textarea');

    for (let i = 0; i < elementInput.length; i++) {
      if (elementInput[i].classList.contains(this.classEdit)) {
        elementInput[i].disabled = true;
      } else {
        elementInput[i].disabled = false;
      }
    }
    for (let j = 0; j < elementTextarea.length; j++) {
      elementTextarea[j].disabled = false;
      if (elementTextarea[j].classList.contains(this.classEdit)) {
        elementTextarea[j].disabled = true;
      } else {
        elementTextarea[j].disabled = false;
      }
    }
    this.objForm.reset();
  }

  /**
   * The function `disabledButton` disables all buttons within a specified form.
   */
  disabledButton() {
    let elementButton = this.objForm.querySelectorAll('button');
    //console.log(elementButton);
    for (let i = 0; i < elementButton.length; i++) {
      elementButton[i].disabled = true;
    }
  }

  /**
   * The function `enabledButton` enables all buttons within a specified form element.
   */
  enabledButton() {
    let elementButton = this.objForm.querySelectorAll('button');
    for (let i = 0; i < elementButton.length; i++) {
      elementButton[i].disabled = false;
    }
  }
  /**
   * The `hiddenButton` function hides all buttons within a specified form element.
   */
  hiddenButton() {
    let elementButton = this.objForm.querySelectorAll('button');
    for (let i = 0; i < elementButton.length; i++) {
      elementButton[i].style.display = "none";
    }
  }
  /**
   * The `showButton` function selects all button elements within a form and sets their display style
   * to "block".
   */
  showButton() {
    let elementButton = this.objForm.querySelectorAll('button');
    for (let i = 0; i < elementButton.length; i++) {
      elementButton[i].style.display = "block";
    }
  }
}

