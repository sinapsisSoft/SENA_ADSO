<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IController
 * 
 */

namespace App\Controllers\User;

/* The lines `use App\System\interface\IController;`, `use App\Models\User\UserModel;`, `use
App\Models\Role\RoleModel;`, `use App\Models\UserStatus\UserStatusModel;`, and `use
App\Config\View;` in the PHP code are importing external classes and interfaces into the current
namespace. */

use App\System\interface\IController;
use App\Models\User\UserModel;
use App\Models\Role\RoleModel;
use App\Models\UserStatus\UserStatusModel;
use App\Config\View;

/* The `UserController` class in PHP contains methods for creating, updating, deleting, and displaying
user data with error handling and JSON responses. */

class UserController implements IController
{
  /* These lines are declaring private properties in the `UserController` class: */
  private $userModel;
  private $roleModel;
  private $userStatusModel;
  private $primaryKey;
  private $data;
  private $view;

  /**
   * The function initializes various models and properties for a PHP class.
   */
  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->roleModel = new RoleModel();
    $this->userStatusModel = new UserStatusModel();
    $this->primaryKey = "User_id";
    $this->data = [];
    $this->view = new View();
  }

  /**
   * The code snippet contains PHP functions for creating and updating data with error handling and JSON
   * response.
   */
  public function create()
  {
    try {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $this->data["data"] = $this->userModel->spCreate($this->getDataModel());
      } else {
        $this->data["error"] = "NOT REQUEST_METHOD GET";
      }
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    echo (json_encode($this->data));
  }

  /**
   * The function `update` processes a PUT request to update user data and returns the result or an
   * error message in JSON format.
   */
  public function update()
  {
    try {
      if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        $this->data["data"] = $this->userModel->spUpdate($this->getDataModel());
      } else {
        $this->data["error"] = "NOT REQUEST_METHOD GET";
      }
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    echo (json_encode($this->data));
  }

  /**
   * The function attempts to delete data using a stored procedure if the request method is DELETE,
   * otherwise it returns an error message.
   */
  public function delete()
  {
    try {
      if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
        $this->data["data"] = $this->userModel->spDelete($this->getDataModel(false));
      } else {
        $this->data["error"] = "NOT REQUEST_METHOD GET OR POST";
      }
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    echo (json_encode($this->data));
  }

  /**
   * The index function retrieves user data, roles, and user status to display in a view, handling any
   * exceptions that may occur.
   * 
   * @return The `index` function is returning the data array which contains the title, users, roles,
   * userStatus, and error (if any).
   */
  public function index()
  {
    try {
      $this->data['title'] = "USER";
      $this->data['users'] = $this->userModel->spShow();
      $this->data['roles'] = $this->roleModel->getRoles();
      $this->data['userStatus'] = $this->userStatusModel->getUserStatus();
      $this->view->render('user/show', $this->data);
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * The function retrieves user data if the request method is GET, otherwise it returns an error
   * message.
   */
  public function show()
  {
    try {
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $this->data["data"] = $this->userModel->spShow();
      } else {
        $this->data["error"] = "NOT REQUEST_METHOD POST";
      }
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    echo (json_encode($this->data));
  }

  /**
   * The function `showId` checks if the request method is POST and calls a method to retrieve user ID
   * data, handling exceptions and returning the result in JSON format.
   */
  public function showId()
  {
    try {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $this->data["data"] = $this->userModel->spShowId($this->getDataModel(false));
      } else {
        $this->data["error"] = "NOT REQUEST_METHOD GET";
      }
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    echo (json_encode($this->data));
  }

  /**
   * The function `getDataModel` in PHP reads JSON input, processes the data based on a condition, and
   * returns an array of requested user data.
   * 
   * @param getId The `getId` parameter in the `getDataModel` function is a boolean parameter that
   * determines whether to include certain fields in the data model array. If `getId` is set to `true`,
   * the function will include fields like `User_user`, `User_password`, `User_status_id`, and `
   * 
   * @return The `getDataModel` function is returning an array `` containing data
   * extracted from the input JSON. The array includes keys such as 'User_id', 'User_user',
   * 'User_password', 'User_status_id', and 'Role_id' based on the condition of ``. If `` is
   * true, all these keys are populated with corresponding values from the input JSON. If `$
   */
  public function getDataModel($getId = true)
  {
    try {
      $jsonData = file_get_contents('php://input');
      $data = json_decode($jsonData, true);
      $_REQUEST = $data;
      $getDataRequest = [];
      if ($getId) {
        $getDataRequest['User_id'] = $_REQUEST['User_id'];
        $getDataRequest['User_user'] = "'" . $_REQUEST['User_user'] . "'";
        $getDataRequest['User_password'] = "'" . password_hash($_REQUEST['User_password'], PASSWORD_DEFAULT) . "'";
        $getDataRequest['User_status_id'] = $_REQUEST['User_status_id'];
        $getDataRequest['Role_id'] = $_REQUEST['Role_id'];
      } else {
        $getDataRequest['User_id'] = $_REQUEST['User_id'];
      }
    } catch (\Exception $e) {
    }
    return $getDataRequest;
  }
}
