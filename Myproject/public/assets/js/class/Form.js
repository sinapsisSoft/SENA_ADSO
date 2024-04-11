/**
 * Author:DIEGO CASALLAS
 * Date:04/04/2024
 * Description:These are the class Form .
 * 
*/
class Form {

  constructor(idForm) {
    this.objForm = document.getElementById(idForm);
    this.icons = new Array("./assets/img/icons/eye-fill.svg", "./assets/img/icons/eye-slash-fill.svg");

  }
  /*Function to take the data from the form object**/
  getForm() {
    return this.objForm;
  }
  /*Function from the form clean**/
  cleanForm() {
    this.objForm.reset();
  };

  /*Function from the form enable**/
  enableForm() {
    let elements = this.objForm.querySelectorAll("input,select");
    for (let i = 0; i < elements.length; i++) {
      elements[i].disabled = false;
    }
  };
  /*Function from the form disable**/
  disableForm() {
    let elements = this.objForm.querySelectorAll("input,select");
    for (let i = 0; i < elements.length; i++) {
      elements[i].disabled = true;
    }
  };

  /*Function from the send data at form**/
  sendDataForm(json) {
    let elements = this.objForm.querySelectorAll("input,select");
    for (let i = 0; i < elements.length; i++) {
      document.getElementById(elements[i].id).value = json[elements[i].id];
    }
  };

  /*Function chnage type input**/
  viewText(id) {
    let objInput = document.getElementById(id);
    let typeInput = "password";
    let iconsInput = this.icons[1];
    if (objInput.type == "password") {
      typeInput = "text";
      iconsInput = this.icons[0];
    } else {
      typeInput = "password";
      iconsInput = this.icons[1];
    }
    objInput.type = typeInput;
    objInput.nextElementSibling.childNodes[0].src = iconsInput;
  }
  /*Function from the get data at form**/
  getDataForm() {
    var elementsForm = this.objForm.querySelectorAll('input, select');
    var formData = new FormData();
    elementsForm.forEach(function (element) {
      if (element.id) {
        if (element.tagName === 'INPUT') {
          if (element.type === 'checkbox') {
            formData.append(element.id, element.checked);
          } else {
            formData.append(element.id, element.value.trim());
          }
        } else if (element.tagName === 'SELECT') {
          formData.append(element.id, element.value.trim());
        }
      }
    });
    return formData;
  }
  /*Function from the get data at form**/
  getJsonForm() {
    var elementsForm = this.objForm.querySelectorAll('input, select');
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
        }
      }
    });
    return getJson;
  }
  /*Function from the validate data at form**/
  setValidateForm() {
    const objForm = this.objForm;
    const inputs = objForm.querySelectorAll('input');
    const selects = objForm.querySelectorAll('select');
    let formValidate = true;
    for (const input of inputs) {
      if (!this.validateInput(input)) {
        formValidate = false;
        this.showMessageError(input);
      }
    }

    for (const select of selects) {
      if (select.value == 0) {
        formValidate = false;
        select.focus();
      }
    }

    if (formValidate) {
      this.hiddenMessageError();
      return true;
    } else {
      return false;
    }
  }
  /*Function from the validate data inputsat form**/
  validateInput(input) {
    const type = input.type;
    switch (type) {
      case 'text':
        return this.validateText(input);
      case 'email':
        return this.validateEmail(input);
      case 'password':
        return this.validatePassword(input);
      case 'number':
        return this.validateNumber(input);
      default:
        return true;
    }
  }


  validateText(input) {
    if (input.value === '') {
      return false;
    }
    return true;
  }

  validateEmail(input) {
    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(input.value);
  }

  validatePassword(input) {
    if (input.value.length < 8) {
      return false;
    }
    return true;
  }

  validateNumber(input) {
    if (isNaN(input.value)) {
      return false;
    }
    return true;
  }

  showMessageError(input) {
    input.classList.add('error');
    const messageError = document.createElement('span');
    messageError.classList.add('menssage-error');
    messageError.textContent = 'This field is invalid';
    input.parentNode.appendChild(messageError);
  }

  hiddenMessageError() {
    const message = document.querySelectorAll('.menssage-error');
    for (let data of message) {
      data.innerHTML = "";
    }
  }
}
