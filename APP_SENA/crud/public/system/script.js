const textConfirmSignOff = 'Press a button!\nEither OK or Cancel.';
function signOff() {
  method = 'POST';
  url = URI_LOGIN + 'singOff';
  data = "";
  if (confirm(textConfirmSignOff) == true) {
    resultFetch = getData(data, method, url);
    resultFetch.then(response => response.json())
      .then(data => {
        location.assign('/login');
      })
      .catch(error => {
        console.error(error);

      })
      .finally();
  }

  async function getData(data, method, url) {
    var parameters;
    //Show Preload 

    if (method == "GET") {
      parameters = {
        method: method,
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest"
        }
      }
    } else {
      parameters = {
        method: method,
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest"
        }
      }
    }
    return await fetch(url, parameters);
  }
}