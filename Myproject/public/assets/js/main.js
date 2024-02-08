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
 * Author:Willian Moreno
 * Date:07/01/2024
 * Update Date:07/01/2024
 * Descriptions:
 * 
 */

/**This funtions is general for validate the form HTML */
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
  
        e.preventDefault();
        return  false;
    
    }