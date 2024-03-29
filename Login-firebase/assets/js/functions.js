const icons = new Array("./assets/img/icons/eye-fill.svg", "./assets/img/icons/eye-slash-fill.svg");

function viewText(id) {
  let objInput = document.getElementById(id);
  let typeInput = "password";
  let iconsInput = icons[1];
  if (objInput.type == "password") {
    typeInput = "text";
    iconsInput = icons[0];
  } else {
    typeInput = "password";
    iconsInput = icons[1];
  }
  objInput.type = typeInput;
  objInput.nextElementSibling.childNodes[0].src = iconsInput;

}