/* Author:DIEGO CASALLAS
* Date:20/03/2025
* Descriptions:This is controller User 
* **/


/* The `window.addEventListener('load', (event) => { show(); });` code snippet is adding an event
listener to the `load` event of the `window` object. When the window has finished loading (i.e.,
when all resources on the page have been loaded), the `show()` function is called. This ensures that
the `show()` function is executed once the entire page has loaded, allowing any necessary
initialization or data retrieval operations to be performed at that time. */
window.addEventListener('load', (event) => {
  show();

});



/**
 * The function "show" calls the "getUsers" and "getRoles" functions.
 */
function show() {
  getUsers();

}






/**
 * The function `getUsers` makes an asynchronous request to fetch user data, creates a table with the
 * data, and then refreshes the table while handling errors and hiding a preload element.
 */
async function getUsers() {
  method = 'GET';
  url = URL + URI_HOME;
  data = {};
  resultFetch = getData(data, method, url);
  resultFetch.then(response => response.json())
    .then(data => {
      //console.log(data);
      ///create table
      createCard(data, "container-cards");
   
      //hidden Preload 
  
    })
    .catch(err => {
      console.error(err);
      //hidden Preload 
 
    })
    .finally();
}

function  createCard(data, id) {
  const objContainerCard = document.getElementById(id);
  objContainerCard.innerHTML = "";
  let card = "";

  for (let i = 0; i < Object.keys(data).length; i++) {
    let obj = Object.entries(data[i]);

    card += `<div  style="margin: 0.28em !important;" class="card col-3 mx-auto">
    <img src="https://t3.ftcdn.net/jpg/06/50/85/90/360_F_650859089_x8aWFsiOw5vpE1h936uAMu7UmXmxPcw2.jpg" class="img img-fluid card-img-top " alt="...">
    <div class="card-body">
      <h5 class="card-title">${obj[1][1]}</h5>
      <p class="card-text">${obj[2][1]}.</p>
      <p class="card-text">${obj[3][1]}</p>
      <a href="#" onclick="alert(${obj[0][1]})" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>`;
  
  }
  objContainerCard.innerHTML = card;
  card = "";
}


/**
 * The function `getData` is an asynchronous function that makes a fetch request with specified data,
 * method, and URL while showing a preload indicator.
 * @param data - The `data` parameter in the `getData` function represents the data that you want to
 * send in the request. It could be an object containing the information you want to send to the
 * server, such as user input or any other relevant data needed for the request.
 * @param method - The `method` parameter in the `getData` function specifies the HTTP request method
 * to be used for fetching data. It can be either "GET" or another HTTP method like "POST", "PUT",
 * "DELETE", etc., depending on the type of request you want to make to the specified URL
 * @param url - The `url` parameter in the `getData` function is the URL to which the HTTP request will
 * be sent. It specifies the location of the resource that the function will interact with.
 * @returns The function `getData` is returning the result of the `fetch` function called with the
 * provided `url` and `parameters`. The `fetch` function performs an asynchronous request to the
 * specified `url` using the given `parameters` and returns a Promise that resolves to the Response to
 * that request.
 */
async function getData(data, method, url) {
  var parameters;
  //Show Preload 
 
  if (method == "GET") {
    parameters = {
      method: method,
      mode: 'cors',
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    }
  } else {
    parameters = {
      method: method,
      mode: 'cors',
      headers: {
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    }
    if (data != "") {
      parameters.body = JSON.stringify(data);
    }
  }
  return await fetch(url, parameters);
}


