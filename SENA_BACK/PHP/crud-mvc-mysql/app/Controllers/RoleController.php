<?php

/**
 * Author:DIEGO CASALLAS
 * Date:15/11/2024
 * Descriptions: This is the class for the role controller functionality manager.
 */

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\RoleModuleModel;
use App\Config\View;

use Exception;

class RoleController
{
  private $data;
  private $model;
  private $idKey;
  private $result;
  private $userApp;
  private $roleModuleModel;
  private $roleModules;
  /**
   * The constructor initializes an empty data array, creates a new instance of the UserModel class, and
   * sets the idKey property to "user_id".
   */
  public function __construct()
  {
    $this->data = [];
    $this->model = new RoleModel();
    $this->data = [];
    $this->userApp=[];
    $this->result = "";
    $this->getModulesRoles();
   
  }
  public function getModulesRoles(){
    $this->roleModuleModel=new RoleModuleModel();
    $this->userApp= $_SESSION[SESSION_APP];
    $userRole= $this->userApp[0]['role_fk'];
    $this->roleModules=$this->roleModuleModel->roleModules($userRole);
  }
  /**
   * The index function initializes data and returns it as a JSON response with status and message.
   */
  public function index() {
    try {
      $this->result = $this->model->findAll();
      $view = new View('role/index');
      $view->set('title', 'Role Index');
      $view->set('roles', $this->result);
      $view->set('roleModules',  $this->roleModules);
      $view->set('getUser',  $this->userApp);
      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
     //echo json_encode($this->data);
  }
  public function viewCreate()
  {
    try {

      $view = new View('role/create');
      $view->set('title', 'Role Create');
      $view->set('roleModules',  $this->roleModules);
      $view->set('getUser',  $this->userApp);
      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    //echo json_encode($this->data);
  }
  /**
   * The function retrieves data from a model in PHP and returns it as a JSON response with status and
   * message information.
   */
  public function show()
  {
    try {
      $results = $this->model->findAll();
      $this->data['data'] = $results;
      $this->data['status'] = 200;
      $this->data['message'] = "ok";
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    echo json_encode($this->data);
  }
  /**
   * The function `showId` in PHP retrieves data based on an ID and returns a JSON response with status
   * and message.
   * 
   * @param int id The `showId` function is a PHP method that takes an integer parameter `` with a
   * default value of `null`.
   */
 
  public function showId(int $id = null)
  {
    try {
      $this->result = $this->model->findId($id);
      $view = new View('role/show');
      $view->set('title', 'Role Show');
      $view->set('role', $this->result);
      $view->set('roleModules',  $this->roleModules);
      $view->set('getUser',  $this->userApp);
      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
     //echo json_encode($this->data);
  }

  /**
   * The create function attempts to create a new entry using a model, returning the results or an error
   * message in JSON format.
   */
  public function edit(int $id = null)
  {
    try {
      $this->result = $this->model->findId($id);
      $view = new View('role/edit');
      $view->set('title', 'Role Edit');
      $view->set('role', $this->result);
      $view->set('roleModules',  $this->roleModules);
      $view->set('getUser',  $this->userApp);
      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
     //echo json_encode($this->data);
  }
  public function create()
  {
    try {
      $this->result  = $this->model->create($this->getDataModel());
      $this->data['data'] = $this->result;
      $this->data['status'] = 200;
      $this->data['message'] = "ok";
      header("Location: index/");
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    //echo json_encode($this->data);
  }
  /**
   * This PHP function updates a record in a database based on the provided ID, handling validation and
   * error messages accordingly.
   * 
   * @param int id The `update` function you provided seems to be updating a record in a database based
   * on the `` parameter. The function first checks if a record with the given `` exists in the
   * database. If it does, it proceeds with the update operation; otherwise, it returns an error message
   */

  
  public function update(int $id = null)
  {
    try {
      if (count($this->model->findId($id)) > 0) {
        $this->result  = $this->model->update($this->getDataModel(), $id);
        $this->data['data'] = $this->result;
        $this->data['status'] = 200;
        $this->data['message'] = "ok";

        header("Location: ".URL_CONTROLLER_ROLE);
      } else {
        $this->data['data'] =  [];
        $this->data['status'] = 404;
        $this->data['message'] = "Error: Validate - User record does not exist";
      }
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    //echo json_encode($this->data);
  }
  public function viewDelete(int $id = null)
  {
    try {
        $this->result = $this->model->findId($id);
        $view = new View('role/delete');
        $view->set('title', 'Role Delete');
        $view->set('role', $this->result);
        $view->set('roleModules',  $this->roleModules);
        $view->set('getUser',  $this->userApp);
        $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    // echo json_encode($this->data);
  }

  /**
   * This PHP function deletes a record based on the provided ID and returns a JSON response with status
   * and message.
   * 
   * @param int id The `delete` function you provided seems to be a part of a class method that handles
   * the deletion of a record based on the provided `id`.
   */

  public function delete(int $id = null)
  {
    try {
        if (count($this->model->findId($id)) > 0) {
          $this->result  = $this->model->delete($id);
          $this->data['data'] = $this->result;
          $this->data['status'] = 200;
          $this->data['message'] = "ok";
          header("Location: ".URL_CONTROLLER_ROLE);
        } else {
          $this->data['data'] =  [];
          $this->data['status'] = 404;
          $this->data['message'] = "Error: Validate - User record does not exist";
        }
    
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    // echo json_encode($this->data);
  }

  /**
   * The function getDataModel in PHP retrieves and processes data from a JSON input.
   * 
   * @return An array named  is being returned by the getDataModel function. The array contains
   * keys 'user_user', 'user_password', 'userStatus_fk', and 'role_fk', with corresponding values based
   * on the data extracted from the JSON input.
   */

  private function getDataModel()
  {
    $data_request = json_decode(file_get_contents('php://input'), true);
  
    if ($data_request != NULL) {
      $getModel['role_name'] = empty($data_request['name']) ? '' : $data_request['name'];
    } else {
      $getModel['role_name'] = empty($_REQUEST['name']) ? '' : $_REQUEST['name'];

    }

    return $getModel;
  }
}
