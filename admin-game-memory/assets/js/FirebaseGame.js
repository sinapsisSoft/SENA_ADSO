/**
 * Author:DIEGO CASALLAS
 * Date:27/03/2024
 * Description:These are the class for managing data from FIREBASE.
 * 
*/
class FirebaseGameUser {

  /**this the method constructor*/
  constructor(idTbody) {
    this.objTbody = document.getElementById(idTbody);
    this.URL = "https://api-rest-cc5ad-default-rtdb.firebaseio.com/api/users";
  }

  /**this the method for get data users*/
  async getDataUsers() {
    return fetch(this.URL + ".json")
      .then((res) => {
        if (!res.ok) {
          console.log('Result: Problem');
          return;
        }
        return res.json();
      })
      .then((data) => {
        this.setTableUser(data);
      })
      .catch((error) => {
        console.error(error);
      })
      .finally();
  }

  /**This is the method async to get user data by id
   * @param id user
  */
  async getDataUser(id) {
    return fetch(this.URL + "/" + id + ".json")
      .then((res) => {
        if (!res.ok) {
          console.log('Result: Problem');
          return;
        }
        return res.json();
      })
      .then((data) => {
        return data;
      })
      .catch((error) => {
        console.error(error);
      })
      .finally();
  }
  /**This is the method to create the table rows using a users Json format
   * @param json user
  */
  setTableUser(data) {
    let contRow = 1;
    let rowTable = "";
    let btnActions = "";
    for (const user in data) {
      let getId = "'" + user + "'";
      btnActions = '<div class="btn-group " role="group" aria-label="Basic mixed styles example">' +
        '<button type="button" onclick="showUser(' + getId + ')" class="btn btn-info"><img class="img img-fluid" src="./assets/img/icons/eye-fill.svg"></button>' +
        '<button type="button" onclick="editUser(' + getId + ')" class="btn btn-warning"><img class="img img-fluid" src="./assets/img/icons/pencil-square.svg"></button>' +
        '<button type="button" onclick="deleteUser(' + getId + ')" class="btn btn-danger"><img class="img img-fluid" src="./assets/img/icons/trash3-fill.svg"></button>' +
        '</div>';
      rowTable += "<tr>" +
        "<td>" + contRow + "</td>" +
        "<td>" + data[user].nombre + "</td>" +
        "<td>" + data[user].nickname + "</td>" +
        "<td>" + data[user].img + "</td>" +
        "<td class='text-center'>" + data[user].valor + "</td>" +
        "<td class='text-center'>" + btnActions + "</td>" +
        "<tr>";
      contRow++;
    }
    this.objTbody.innerHTML = rowTable;
  }

  /**This is the method to create the new data item in user Json format
  * @param json user
  */
  async setCreateUser(data) {
    return fetch(this.URL + ".json", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then((res) => {
        if (!res.ok) {
          console.log('Result: Problem');
          return;
        }
        return res.json();
      })
      .then((data) => {
        this.getDataUsers();
      })
      .catch((error) => {
        console.error(error);
      })
      .finally();
  }
  /**This is the method to update the element by sending a set of data in Json format from the user
  * @param json user
  @param id user
  */
  async setUpdateUser(id, data) {
    return fetch(this.URL + "/" + id + ".json", {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then((res) => {
        if (!res.ok) {
          console.log('Result: Problem');
          return;
        }
        return res.json();
      })
      .then((data) => {
        this.getDataUsers();
      })
      .catch((error) => {
        console.error(error);
      })
      .finally();
  }
  /**This is the method to delete the element
  @param id user
  */
  async setDeleteUser(id) {
    return fetch(this.URL + "/" + id + ".json", {
      method: 'DELETE'
    })
      .then((res) => {
        if (!res.ok) {
          console.log('Result: Problem');
          return;
        }
        return res.json();
      })
      .then((data) => {
        return data;
      })
      .catch((error) => {
        console.error(error);
      })
      .finally();
  }
}