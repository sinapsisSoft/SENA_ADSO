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

    // Configuración de validaciones por tipo de input
    this.VALIDATIONS = {
      text: {
        messageError: "Please enter a valid text (3-20 alphanumeric characters)",
        regExp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]{3,20}$/
      },
      number: {
        messageError: "Please enter a valid Number (0-9 numeric characters)",
        regExp: /^[0-9]*$/
      },
      email: {
        messageError: "Please enter a valid Email",
        regExp: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
      },
      password: {
        messageError: "Password must: be 8-15 chars, have lowercase, uppercase, number, and special character ($@$!%*?&)",
        regExp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/
      },
      
    };
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
    const elementsForm = Array.from(this.objForm.querySelectorAll("input, select, textarea"));

    for (const element of elementsForm) {
      if(!element.classList.contains(this.classEdit))
      if (!this.validateInputs(element)) {
        // If any input is invalid, return false
        element.focus();
        return false;
      }
    }
    return true;
  };

  validateInputs(input) {
    const type = input.type;
    const validation = this.VALIDATIONS[type];

    if (!validation) return true; // No validation rules for this type of input
    const isValid = validation.regExp.test(input.value.trim());

    if (!isValid) {
      input.classList.add("is-invalid");
      const spanError = input.parentNode.querySelectorAll("span");
      if (spanError.length == 0) {
        let objSpan = document.createElement("span");
        objSpan.classList.add("text-danger");
        objSpan.innerHTML = validation.messageError;
        input.parentNode.insertBefore(objSpan, input.nextSibling);
      }else{
        console.log(spanError[0].classList);
        spanError[0].classList.add("text-danger");
        spanError[0].innerHTML = validation.messageError;
      }
      return false;
    } else {
      input.classList.remove("is-invalid");
      const spanError = input.parentNode.querySelectorAll("span");
      if (spanError.length > 0) {
        spanError[0].classList.remove("text-danger");
        spanError[0].innerHTML = "";
      }
    }

    return isValid
  };



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
    let elementInput = this.objForm.querySelectorAll('input,select');
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
    let elementInput = this.objForm.querySelectorAll('input,select');
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
    let elementInput = this.objForm.querySelectorAll('input,select');
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
    let elementInput = this.objForm.querySelectorAll('input,select');
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

