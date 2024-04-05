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
  getForm(){
    return this.objForm;
  }

  cleanForm() {
    this.objForm.reset();
  };


  enableForm() {
    let elements = this.objForm.querySelectorAll("input");
    for (let i = 0; i < elements.length; i++) {
      elements[i].disabled = false;
    }
  };


  disableForm() {
    let elements = this.objForm.querySelectorAll("input");
    for (let i = 0; i < elements.length; i++) {
      elements[i].disabled = true;
    }
  };

  setDataForm(json) {
    let elements = this.objForm.querySelectorAll("input");
    for (let i = 0; i < elements.length; i++) {
      document.getElementById(elements[i].id).value = json[elements[i].id];
    }
  };

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

  getDataForm() {
    var elementsForm = this.objForm.querySelectorAll('input');
  }
}
