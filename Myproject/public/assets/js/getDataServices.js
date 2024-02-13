function getDataJson(){

  const url="http://localhost/SENA/SENA_ADSO/Myproject/app/Config/Config.php";

  fetch(url,{
    method: "GET", // or 'PUT' // data can be `string` or {object}!
    headers: {
      "Content-Type": "application/json"
    },
  })
  .then(response => response.json())
  .then(data =>{
    let dataResult=data;
    console.log(dataResult);
  })
  .catch(error => console.error('Error:', error));


}