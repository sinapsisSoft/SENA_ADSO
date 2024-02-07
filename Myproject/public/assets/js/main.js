/**
 * Author:
 * Date:
 * Update Date:
 * Descriptions:
 * 
 */

/**This funtions is general for validate the form HTML */
function validateForm() {
/**This is the variable declarations*/
    var objInputEmail = document.getElementById("user_email");
    var objInputPassword = document.getElementById("user_password");
    let valueEmail = objInputEmail.value;
    let valuePassword = objInputPassword.value;
    let countValue = valueEmail.length;
/***/
    console.log(countValue);
    if (countValue == 0) {
        alert('no hay email o password');
        console.log(objInputEmail);
        objInputEmail.style.background = "red";
    } else {
        objInputEmail.disabled = true;
        objInputEmail.style.background = "green";
    }

}