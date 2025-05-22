const objForm = document.getElementById("salaryForm");
const getElements = objForm.querySelectorAll("input");
const URL = "http://localhost:3000/api_v1/";
const URL_SALARY = "classify";

objForm.addEventListener("submit", function (e) {
  e.preventDefault();
  for (let i = 0; i < getElements.length; i++) {
    let element = getElements[i];
    if (element.type === "text" || element.type === "number") {
      if (getValidatedInput(element)) {
        setDataServices(element.value);
      } else {
        alert("Please enter a valid input.");
        break;
      }
    }
  }
});

function getValidatedInput(objInput) {
  let objInputValue = objInput.value;
  let classError = "input-error";
  let myRegex = /^\d{5,}$/;
  let validation = myRegex.test(objInputValue);
  let validations = true;
  if (objInputValue == "" || objInputValue == null || objInputValue.length <= 0) {
    objInput.classList.add("input-error");
    validations = false;
  } else if (!validation) {
    objInput.classList.add("input-error");
    validations = false;
  }
  else {
    objInput.classList.remove(classError);
  }
  return validation;
}

function setDataServices(data) {
  let getData = {
    "salary": data
  };
  const method = 'POST';
  const url = URL + URL_SALARY;
  resultFetch = getDataServices(getData, method, url);
  resultFetch.then(response => {
    return response.json();
  }).then(data => {
    console.log(data);
    alert("Success: OK");
  }).catch(error => {
    console.error('Error:', error);
    alert("Error: " + error);
  }).finally(() => {
    console.log("Request completed");
  });
}




