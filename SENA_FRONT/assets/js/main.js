
let setIdForm = "my-form";
let setIdBtn = "btnSubmit";
const objForm = document.getElementById(setIdForm);
var btnSendData = document.getElementById(setIdBtn);
var result = new Object();
var getPatterns;

btnSendData.addEventListener('click', function (event) {
  event.preventDefault();
  console.log(validateForm());
  return false;
});

function validateForm() {

  for (let i = 0; i < objForm.children.length; i++) {
    let element = objForm[i];

    if (element.type == "checkbox") {
      
      if (!element.checked) {
        result.status = false;
        result.ms = "Error: checkbox checked";
        break;
      }
    } else if (element.type == "radio") {
      let getRadio = document.getElementsByName(element.name);

      for (let j = 0; j < getRadio.length; j++) {
        if (!getRadio[j].checked) {
          result.status = false;
          result.ms = "Error: radio checked";
          i = objForm.children.length;
          break;
        }
      }
    }
    else if(element.type =='select-one'){
    
        if(element.value==0){
          result.status = false;
          messages="Validate Select";
          break;
        }
       
    }
    else {
      //debugger;
      let getElementValue = element.value;
      let reg ;
      let messages;
      switch (element.type) {
        case 'text':
          getPatterns = "^[a-zA-Z]{5,}$";
          messages="The text entered is not valid";
          break;
        case 'password':
          getPatterns = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&])[A-Za-z\\d@$!%*?&]{8,}$";
          messages="The password does not meet the established value (8 character, 1 uppercase, 1 lowercase letter and 1 character)";
          break;
        case 'email':
          getPatterns ="^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$";
          messages="The email entered is not valid";
          break;
       
      }
       reg = new RegExp(getPatterns);
      if(reg.exec(getElementValue)==null){
        result.status = false;
        result.ms = messages;
        break;
      }else{
        result.status = true;
        result.ms = "Ok Data";
      }
 
    }
  }

  return result;
}

