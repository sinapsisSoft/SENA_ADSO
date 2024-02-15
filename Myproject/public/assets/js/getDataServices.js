function getUserJson(){

  const url="http://localhost/SENA/SENA_ADSO/Myproject/app/Config/Config.php";

  fetch(url,{
    method: "GET", // or 'PUT' // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json"
    },
  })
  .then(response => response.json())
  .then(data =>{

    createTableArray(data);
  })
  .catch(error => console.error('Error:', error));


}
function getUserStatusJson(){

  const url="http://localhost/SENA/SENA_ADSO/Myproject/app/Config/RoleController.php";

  fetch(url,{
    method: "GET", // or 'PUT' // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json"
    },
  })
  .then(response => response.json())
  .then(data =>{

    if(data.length==0){
      alert("Not data");
    }else{
    createSelectArray(data);
    }
  
    hideenPreload();
    

  })
  .catch(error => {console.error('Error:', error);hideenPreload();});

  


}