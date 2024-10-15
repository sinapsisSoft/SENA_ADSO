/*
*Author:DIEGO CASALLAS
*Date:12/10/2024
*Descriptions:This class contains a set functions for validating form data entries
*/
/* The `Form` class in JavaScript provides methods for validating form input fields based on specific
criteria and returning a result object indicating the validation status. */
class Form {
  /**
   * The constructor function initializes properties for a form validation object in JavaScript.
   * @param idForm - The `idForm` parameter is the ID of the form element in the HTML document that you
   * want to work with in your JavaScript code.
   */
    constructor(idForm) {
      this.form = document.getElementById(idForm);
      this.result = new Object();
      this.getPatterns = new Object();
      this.reg = null;
      this.elementsInput = [];
      this.elementsSelect = [];
      this.validateForm = true;
    }
  
  /**
   * The function `validate()` in JavaScript is used to validate form input fields based on specific
   * criteria and return a result object indicating the validation status.
   * @returns The `validate()` function returns the `result` object which contains the status of the
   * validation process and a message indicating whether the data is valid or not.
   */
    validate() {
      this.elementsInput = this.form.querySelectorAll('input');
      this.elementsSelect = this.form.querySelectorAll('select');
      var validateCheck = true;
      for (var i = 0; i < this.elementsInput.length; i++) {
        this.getPatterns.data = this.elementsInput[i].value.trim();
        switch (this.elementsInput[i].type) {
          case 'checkbox':
            validateCheck = false;
            if (!this.elementsInput[i].checked) {
              this.result.status = false;
              this.result.message = "It is mandatory to check";
              this.elementsInput[i].focus();
              i = this.elementsInput.length;
              break;
            }
          case 'email':
            this.getPatterns.pattern = "^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$";
            this.getPatterns.message = "The email is not valid";
            break;
          case 'number':
            this.getPatterns.pattern = "^\d{5,}$";
            this.getPatterns.message = "The number is not valid";
            break;
          case 'password':
            this.getPatterns.pattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$";
            this.getPatterns.message = "The password does not meet the set values ​​(8 characters, 1 uppercase letter, 1 lowercase letter and 1 character)";
            break;
          case 'radio':
            let getRadio = document.getElementsByName(this.elementsInput[i].name);
            let getValidateRadio = this.validateRadio(getRadio);
            validateCheck = false;
            if (getValidateRadio['status'] == false) {
              this.result.status = false;
              this.result.message = "It is mandatory to radio check";
              this.elementsInput[i].focus();
              i = this.elementsInput.length;
            }
            break;
          case 'range':
            break;
          case 'text':
            this.getPatterns.pattern = "^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,}( [A-Za-zÁÉÍÓÚáéíóúÑñ]{2,})?$";
            this.getPatterns.message = "The text must be at least 6 characters long. The first and last characters must not be blank spaces. Blank spaces are allowed between words.";
            break;
          default:
            break;
        }
        if (validateCheck) {
          if (this.validateInput(this.elementsInput[i], this.getPatterns)['status'] == false) {
            this.validateForm = false;
            this.result.status = false;
            this.result.message = this.getPatterns.message;
            break;
          }
        }
      }
      if (this.validateForm) {
        let getValidateSelect = this.validateSelect(this.elementsSelect);
        if (getValidateSelect['status'] == false) {
          this.result.status = false;
          this.result.message = getValidateSelect['message'];
        } else {
          this.result.status = true;
          this.result.message = "Ok Data";
        }
      }
      return this.result;
    }
  
   /**
    * The function `validateInput` checks if the input data matches a specified pattern and returns a
    * result object with status and message.
    * @param getInput - `getInput` is a function that retrieves the input element from the DOM that you
    * want to validate.
    * @param getPattern - getPattern is an object that contains the following properties:
    * @returns The `result` object is being returned from the `validateInput` function. The `result`
    * object contains a `status` property indicating whether the input data is valid or not, and a
    * `message` property providing a message related to the validation result.
    */
    validateInput(getInput, getPattern) {
      this.result.status = true;
      this.result.message = "Ok Data";
      let pattern = getPattern['pattern'];
      this.reg = new RegExp(pattern);
      if (this.reg.exec(getPattern['data']) == null) {
        this.result.status = false;
        this.result.message = getPattern['message'];
        getInput.focus();
      }
      return this.result;
    }
  
   /**
    * The function `validateSelect` checks if at least one value is selected from a list of dropdown
    * options.
    * @param getSelects - `getSelects` is an array containing select elements from a form that need to be
    * validated.
    * @returns The `result` object is being returned from the `validateSelect` function.
    */
    validateSelect(getSelects) {
      for (let j = 0; j < getSelects.length; j++) {
        if (getSelects[j].value === "") {
          this.result.status = false;
          this.result.message = "At least one value must be selected from the list";
          this.validateForm = false;
          break;
        }
      }
      return this.result;
    }
  
   /**
    * The function `validateRadio` checks if at least one radio button in a group is checked and returns
    * a status indicating whether any radio button is checked.
    * @param getRadio - The `getRadio` parameter in the `validateRadio` function is expected to be an
    * array of radio input elements. The function loops through each radio input element in the array to
    * check if it is checked. If at least one radio input is checked, the function sets the status to
    * true and breaks
    * @returns The `result` object with the `status` property indicating whether any radio button is
    * checked or not.
    */
    validateRadio(getRadio) {
      this.result.status = false;
      for (let k = 0; k < getRadio.length; k++) {
        if (getRadio[k].checked) {
          this.result.status = true;
          break;
        }
      }
      return this.result;
    }
  } 