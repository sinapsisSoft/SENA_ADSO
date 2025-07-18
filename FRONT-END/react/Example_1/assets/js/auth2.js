const authForm = document.getElementById("my-form");
const usernameInput = document.getElementById("username");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const error = document.getElementById("error");

console.log(authForm);

authForm.addEventListener("submit", (e) => {
  e.preventDefault();
  if (!validateForm()) {
    error.textContent = "Please fill in all fields";
  } else {
    error.textContent = "";
    // Perform form submission logic here
  }
});

function validateForm() {
  let isValid = true;
  if (usernameInput.value === "") {
    usernameInput.classList.add("is-invalid");
    isValid = false;
  } else {
    usernameInput.classList.remove("is-invalid");
  }
  if (emailInput.value === "") {
    emailInput.classList.add("is-invalid");
    isValid = false;
  } else {
    emailInput.classList.remove("is-invalid");
  }
  if (passwordInput.value === "") {
    passwordInput.classList.add("is-invalid");
    isValid = false;
  } else {
    passwordInput.classList.remove("is-invalid");
  }
  return isValid;
}