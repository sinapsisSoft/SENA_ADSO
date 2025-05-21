function validateInput(event){
  debugger;
  let objInput = document.getElementById("salaryInput");
  console.log(typeof(objInput.value));
  if (objInput.value == "" || objInput.value == null || objInput.value.length <=0) { 
    alert("Please enter a valid input.");
    //objInput.focus();
    objInput.classList.add("input-error");
    console.log(objInput.classList);
    
  }
  event.preventDefault();
}

