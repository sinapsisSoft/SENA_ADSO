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

getDataJson();

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
    objForm = document.getElementById(id);
    elements = objForm.querySelectorAll("input");
    elementsLeng = elements.length;
    for (let i = 0; i < elementsLeng; i++) {
        let element = elements[i];
        if (element.value == "" || element.length == 0) {
            alert("Error: Validate Element");
            element.classList.add('errorInput');
            e.preventDefault();
            return false;
        } else {
            element.classList.remove('errorInput');
        }
    }
    e.preventDefault();
    return false;
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
function editUser(id,idUser) {
    clearData(id);
    formEnable(id);
    formEnableEdit(id);
    showModal();
    alert("ID USER"+idUser);
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
function viewUser(id,idUser) {

    clearData(id);
    formDisabled(id);
    showModal();
    alert("ID USER"+idUser);
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
        rowTable = rowTable+'<tr><th scope="row">'+getArray[i].User_id+'</th><td>'+getArray[i].User_user+'</td><td>Otto</td><td>@mdo</td></tr>';
        
    }
    containerTable.innerHTML = textTable + tHead + rowTable + textTableEnd;
}

function createTableArray(getArray) {
    const containerTbody = document.getElementById('idTbody');
    var formId="'form_login'";
    let rowTable = '';
    let row = getArray.length;
    for (let i = 0; i < row; i++) {
        rowTable = rowTable+'<tr><th scope="row">'+(i+1)+'</th><td>'+getArray[i].User_user+'</td><td>'+getArray[i].User_password+'</td><td>'+getArray[i].User_status_name+'</td><td>'+getArray[i].Role_name +'</td><td><div class="btn-group" role="group"aria-label="Basic mixed styles example"><button type="button" onclick="viewUser('+formId+','+getArray[i].User_id+')"class="btn btn-success"><img src="../../../public/assets/img/icons/eye-fill.svg"></button><button type="button" onclick="editUser('+formId+','+getArray[i].User_id+')"class="btn btn-warning"><img src="../../../public/assets/img/icons/pencil-square.svg"></button><button type="button" onclick="deleteUser('+formId+','+getArray[i].User_id+')"class="btn btn-danger"><img src="../../../public/assets/img/icons/trash3-fill.svg"></button></div></td></tr>';
        
    }
    containerTbody.innerHTML = rowTable;
}


// createTable();