function getDataJson(){
    var url = "https://firebasestorage.googleapis.com/v0/b/dev-fortress-296821.appspot.com/o/dataText.json?alt=media&token=eadfc6ad-c12d-4c34-914a-2eabaedf4d00";
   // var url = "https://www.sinapsissoft.com/sena/dataText.json";
var data = { username: "example" };
fetch(url, {
        method: "GET", // or 'PUT' // data can be `string` or {object}!
        headers: {
          "Content-Type": "application/json"
        },
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}
