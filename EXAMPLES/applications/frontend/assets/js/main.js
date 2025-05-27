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
    setDataClassifications(data['result']['class']);
    alert("Success: OK");
  }).catch(error => {
    console.error('Error:', error);
    alert("Error: " + error);
  }).finally(() => {
    console.log("Request completed");
  });
}

function setDataClassifications(data) {
  const classifications = document.getElementById("classifications");
  let min = new Intl.NumberFormat(["ban", "id"]).format(data['min']);
  let max = new Intl.NumberFormat(["ban", "id"]).format(data['max']);
  let daySalary = new Intl.NumberFormat(["ban", "id"]).format(data['DaySalary']);
  classifications.innerHTML = "";
  classifications.innerHTML = `
  <div class="col-md-8 mx-auto">
    <div class="card salary-class-card shadow" style="border-left:5px solid ${data['color']}">
      <div class="card-header" style="background-color: ${data['color']}; color: white;">
        <h3 class="card-title mb-0"><i class="fas fa-crown me-2"></i>Tu Clasificación</h3>
      </div>
      <div class="card-body">
        <h2 class="text-center mb-4" style="color: ${data['color']};">${data['nombre']}</h2>
        <div class="row">
          <div class="col-md-6">
            <p><strong>Rango Salarial Anual:</strong></p>
            <div class="d-flex align-items-center mb-3">
              <span class="badge bg-dark me-2">Mín</span>
              <span>$${min}</span>
            </div>
            <div class="d-flex align-items-center">
              <span class="badge bg-dark me-2">Máx</span>
              <span>$${max}</span>
            </div>
          </div>
          <div class="col-md-6">
            <p><strong>Salario Diario:</strong> $${daySalary}</p>
            <p><strong>Descripción:</strong> ${data['descripcion']}</p>
          </div>
        </div>
      </div>
    </div>
  </div>`;
  classifications.style.display = "block";
}



