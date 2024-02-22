/**
 * Author:Willian Moreno
 * Date:07/01/2024
 * Update Date:07/01/2024
 * Descriptions:
 * 
 */
/**Varibles*/
const myModal = new bootstrap.Modal(document.getElementById("modalUser"), {});
var objForm = null;
var elements = null;
var elementsLeng = 0

/*************/
window.addEventListener("load",function(){
    getUserJson();
    getUserStatusJson();
    getRoleJson();  
});


/**This funtions is general for validate the form HTML */
function validateForm() {
    /**This is the variable declarations*/
    objForm = document.getElementById("form_login");
    elements = objForm.querySelectorAll("input");
    for (let i = 0; i < elements.length; i++) {
        console.log(elements[i].value);
        if (elements[i].value == "") {
            alert("Valide los datos ingresados");
            elements[i].focus();
            return false;
        }
    }
}
/**
 * Author:DIEGO CASALLAS
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is for get form object and validate
 * Return:value boolean
 * Parameter: 
 * @id is identification the form
 * @e is event the form
 */
function getData(id, e) {
    var validate=false;
    if (validateForm(id)) {
        //getDataForm(id);
        validate=true;
    }


    alert(validate);
    e.preventDefault();
    return validate;
}
function validateForm(id) {
    objForm = document.getElementById(id);
    elements = objForm.querySelectorAll("input");
    elementsLeng = elements.length;

    for (let i = 0; i < elementsLeng; i++) {
        let element = elements[i];
        if (element.value == "" || element.length == 0) {
            alert("Error: Validate Element");
            element.classList.add('errorInput');
            return false;
        } else {
            element.classList.remove('errorInput');
        }
    }
    return true;
}

function getDataForm(id) {
    objForm = document.getElementById(id);
    elementsInput = objForm.querySelectorAll("input");
    elementsSelect = objForm.querySelectorAll("select");
    elementsLeng = elementsInput.length;
    elementsLengSelect = elementsSelect.length;
    for (let i = 0; i < elementsLeng; i++) {
        let element = elementsInput[i];
        console.log(element.value);
    }
    for (let i = 0; i < elementsLengSelect; i++) {
        let element = elementsSelect[i];
        console.log(element.value);
    }
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is clearData
 * Return:
 * Parameter: 
 * @id is identification the form

*/
function clearData(id) {

    objForm = document.getElementById(id);
    elements = objForm.querySelectorAll("input");
    elementsLeng = elements.length;
    for (let i = 0; i < elementsLeng; i++) {
        let element = elements[i];
        element.value = "";
    }
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is formDisabled
 * Return:
 * Parameter: 
 * @id is identification the form

*/
function formDisabled(id) {
    objForm = document.getElementById(id);
    elements = objForm.querySelectorAll("input");
    elementsLeng = elements.length;
    for (let i = 0; i < elementsLeng; i++) {
        let element = elements[i];
        element.disabled = true;
    }
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is formEnable
 * Return:
 * Parameter: 
 * @id is identification the form

*/
function formEnable(id) {
    objForm = document.getElementById(id);
    elements = objForm.querySelectorAll("input");
    elementsLeng = elements.length;
    for (let i = 0; i < elementsLeng; i++) {
        let element = elements[i];
        element.disabled = false;
    }
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is formEnableEdit
 * Return:
 * Parameter: 
 * @id is identification the form

*/
function formEnableEdit(id) {
    objForm = document.getElementById(id);
    elements = objForm.querySelectorAll(".input_disabled");
    elementsLeng = elements.length;
    for (let i = 0; i < elementsLeng; i++) {
        let element = elements[i];
        element.disabled = true;
    }
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is createUser
 * Return:
 * Parameter: 
 * @id is identification the form

*/
function createUser(id) {
    clearData(id);
    formEnable(id);
    showModal();
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is editUser
 * Return:
 * Parameter: 
 * @id is identification the form

*/
function editUser(id, idUser) {
    clearData(id);
    formEnable(id);
    formEnableEdit(id);
    showModal();
    alert("ID USER" + idUser);
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is deleteUser
 * Return:
 * Parameter: 
 * @id is identification the user

*/
function deleteUser(id) {
    let getConfirm = window.confirm("Seguro desea Eliminar?");
    if (getConfirm) {
        alert("OK DELETE");
    } else {
        alert("ERROR DELETE");
    }
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is deleteUser
 * Return:
 * Parameter: 
 * @id is identification the form
 */
function viewUser(id, idUser) {

    clearData(id);
    formDisabled(id);
    showModal();
    alert("ID USER" + idUser);
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is showModal
 * Return:
 * Parameter: 
 * @id is identification the form
 */
function showModal() {
    myModal.show();
}

/**
 * Author:
 * Date:08/01/2024
 * Update Date:
 * Descriptions: This functions is hiddenModal
 * Return:
 * Parameter: 
 * @id is identification the form
 */
function hiddenModal() {
    myModal.hidden();
}


function createTable(getArray) {
    const containerTable = document.getElementById('id_table');
    const textTable = '<table class="table">';
    const tHead = '<thead><tr><th scope="col">#</th><th scope="col">First</th><th scope="col">Last</th><th scope="col">Handle</th></tr></thead><tbody>';
    const textTableEnd = '</tbody></table>';
    let rowTable = '';
    let row = getArray.length;
    for (let i = 0; i < row; i++) {
        rowTable = rowTable + '<tr><th scope="row">' + getArray[i].User_id + '</th><td>' + getArray[i].User_user + '</td><td>Otto</td><td>@mdo</td></tr>';

    }
    containerTable.innerHTML = textTable + tHead + rowTable + textTableEnd;
}

function createTableArray(getArray) {
    const containerTbody = document.getElementById('idTbody');
    var formId = "'form_login'";
    let rowTable = '';
    let row = getArray.length;
    for (let i = 0; i < row; i++) {
        rowTable = rowTable + '<tr><th scope="row">' + (i + 1) + '</th><td>' + getArray[i].User_user + '</td><td>' + getArray[i].User_password + '</td><td>' + getArray[i].User_status_name + '</td><td>' + getArray[i].Role_name + '</td><td><div class="btn-group" role="group"aria-label="Basic mixed styles example"><button type="button" onclick="viewUser(' + formId + ',' + getArray[i].User_id + ')"class="btn btn-success"><img src="../../../public/assets/img/icons/eye-fill.svg"></button><button type="button" onclick="editUser(' + formId + ',' + getArray[i].User_id + ')"class="btn btn-warning"><img src="../../../public/assets/img/icons/pencil-square.svg"></button><button type="button" onclick="deleteUser(' + formId + ',' + getArray[i].User_id + ')"class="btn btn-danger"><img src="../../../public/assets/img/icons/trash3-fill.svg"></button></div></td></tr>';

    }
    containerTbody.innerHTML = rowTable;
}
function createTableArrayPhp(getArray) {
    const containerTbody = document.getElementById('idTbody');
    var formId = "'form_login'";
    let rowTable = '';
    let row = getArray.length;
    for (let i = 0; i < row; i++) {
        rowTable = rowTable + '<tr><th scope="row">' + (i + 1) + '</th><td>' + getArray[i].User_user + '</td><td>' + getArray[i].User_password + '</td><td>' + getArray[i].User_status_name + '</td><td>' + getArray[i].Role_name + '</td><td><div class="btn-group" role="group"aria-label="Basic mixed styles example"><a href="../../Config/UserControllerShowID.php?User_id=' + getArray[i].User_id + '"><button type="button" onclick="//viewUser(' + formId + ',' + getArray[i].User_id + ')"class="btn btn-success"><img src="../../../public/assets/img/icons/eye-fill.svg"></button></a><a href="../../Config/UserControllerEdit.php?User_id=' + getArray[i].User_id + '"><button type="button" onclick="//editUser(' + formId + ',' + getArray[i].User_id + ')"class="btn btn-warning"><img src="../../../public/assets/img/icons/pencil-square.svg"></button></a><button type="button" onclick="deleteUser(' + formId + ',' + getArray[i].User_id + ')"class="btn btn-danger"><img src="../../../public/assets/img/icons/trash3-fill.svg"></button></div></td></tr>';

    }
    containerTbody.innerHTML = rowTable;
}

function createSelectArray(getArray,id) {
    const containerSelect = document.getElementById(id);

    var optionSelect = '<option selected>Open this select menu</option>';
    let row = getArray.length;
    for (let i = 0; i < row; i++) {
        let element=Object.values(getArray[i]);
        optionSelect = optionSelect + '<option value="' +element[0] + '">' + element[1] + '</option>';

    }
    containerSelect.innerHTML = optionSelect;
}

const OBJpreload = document.getElementById('preload');
function showPreload() {
    OBJpreload.style.display = "block";
}

function hideenPreload() {
    OBJpreload.style.display = "none";
    //console.log(OBJpreload);
}

function viewPassword(idBtn) {
    let objBtn = document.getElementById(idBtn);
    let mySrc = "";
    let objImg = objBtn.firstChild;
    let textInput = "";
    let objInput = objBtn.parentElement.children[0];

    if (objInput.type == "text") {
        mySrc = "../../../public/assets/img/icons/eye-slash-fill.svg";
        textInput = "password";
    } else {
        mySrc = "../../../public/assets/img/icons/eye-fill.svg";
        textInput = "text";
    }
    objImg.src = mySrc;
    objInput.type = textInput;

}



// createTable();