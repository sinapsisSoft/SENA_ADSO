/**
 * Author:Willian Moreno
 * Date:07/01/2024
 * Update Date:07/01/2024
 * Descriptions:
 * 
 */

/**This funtions is general for validate the form HTML */
function validateForm() {
/**This is the variable declarations*/
    var objForm=document.getElementById("form_login");
    var elements=objForm.querySelectorAll("input");
    for(let i=0;i<elements.length;i++){
        console.log(elements[i].value);
        if(elements[i].value == ""){
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
function getData(id,e) {

        var objForm=document.getElementById(id);
        var elements=objForm.querySelectorAll("input");
        var elementsLeng=elements.length;

        for(let i=0;i<elementsLeng;i++){
            let element=elements[i];
            if(element.value=="" || element.length==0){
                alert("Error: Validate Element");
                element.classList.add('errorInput');
                e.preventDefault();
                return false;
            }else{
                element.classList.remove('errorInput');
            }
        }
        //getDataJson();
        e.preventDefault();
        return  false;
    
    }
    //getDataJson();
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

function clearData(id) {

    var objForm=document.getElementById(id);

    var elements=objForm.querySelectorAll("input");
    var elementsLeng=elements.length;
    
    for(let i=0;i<elementsLeng;i++){
        let element=elements[i];
        element.value = "";
    }
}


function formDisabled(id) {

    var objForm=document.getElementById(id);
    var elements=objForm.querySelectorAll("input");
    var elementsLeng=elements.length;
    
    for(let i=0;i<elementsLeng;i++){
        let element=elements[i];
        element.disabled = true;

    }
}

function formEnable(id) {

    var objForm=document.getElementById(id);
    var elements=objForm.querySelectorAll("input");
    var elementsLeng=elements.length;
    
    for(let i=0;i<elementsLeng;i++){
        let element=elements[i];
        element.disabled = false;

    }
}


function formEnableEdit(id) {

    var objForm=document.getElementById(id);
    var elements=objForm.querySelectorAll(".input_disabled");
    var elementsLeng=elements.length;
    
    for(let i=0;i<elementsLeng;i++){
        let element=elements[i];
        element.disabled = true;
    }
}


function createUser (id) {
    clearData(id);
    formEnable(id);
    showModal();
}

function editUser(id) {
    clearData(id);
    formEnable(id);
    formEnableEdit(id);
    showModal();
}

function deleteUser(id) {
  
   let getConfirm=window.confirm("Seguro desea Eliminar?");
   //console.log(getConfirm);
   if(getConfirm){
alert("OK DELETE");
   }else{
    alert("ERROR DELETE");
   }
}

function viewUser(id) {
    clearData(id);
    formDisabled(id);
    showModal();
}

function showModal() {
    var myModal = new bootstrap.Modal(document.getElementById("modalUser"), {});
    myModal.show();
}

function hiddenModal() {
    var myModal = new bootstrap.Modal(document.getElementById("modalUser"), {});
    myModal.hidden();
}
//input_disabled