const authForm = document.getElementById("my-form");
const errorElement = document.getElementById("error");
const inputs = Array.from(authForm.querySelectorAll("input"));

// Configuración de validaciones por tipo de input
const VALIDATIONS = {
  text: {
    messageError: "Please enter a valid User name (3-20 alphanumeric characters)",
    regExp: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9]{3,20}$/
  },
  email: {
    messageError: "Please enter a valid Email",
    regExp: /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
  },
  password: {
    messageError: "Password must: be 8-15 chars, have lowercase, uppercase, number, and special character ($@$!%*?&)",
    regExp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/
  }
};

authForm.addEventListener("submit", (e) => {
  e.preventDefault();
  if (validateForm()) {
    // Perform form submission logic here
  }
});

function validateForm() {
  for (const input of inputs) {
    if (!validateInput(input)) {
      input.focus();
      return false;
    }
  }
  return true;
}

function validateInput(input) {
  const type = input.type || input.getAttribute("type");
  const validation = VALIDATIONS[type];
  
  if (!validation) return true; // Si no hay validación definida, se considera válido
  
  const isValid = validation.regExp.test(input.value.trim());
  
  if (isValid) {
    input.classList.remove("error");
    errorElement.textContent = "";
  } else {
    input.classList.add("error");
    errorElement.textContent = validation.messageError;
  }
  
  return isValid;
}