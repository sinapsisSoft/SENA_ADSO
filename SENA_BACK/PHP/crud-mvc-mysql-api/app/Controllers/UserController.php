<?php

/**
 * Author:DIEGO CASALLAS
 * Date:13/11/2024
 * Descriptions: This is the user class controller data model
 */

namespace App\Controllers;

use App\Models\UserModel;

use Exception;

class UserController
{
  private $data;
  private $model;
  private $idKey;
  /**
   * The constructor initializes an empty data array, creates a new instance of the UserModel class, and
   * sets the idKey property to "user_id".
   */
  public function __construct()
  {
    $this->data = [];
    $this->model = new UserModel();
    $this->idKey = "user_id";
  }
  /**
   * The index function initializes data and returns it as a JSON response with status and message.
   */
  public function index() {}
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
      if (!empty($id)) {
        $results = $this->model->findId($id);
        $this->data['data'] = $results;
        $this->data['status'] = 200;
        $this->data['message'] = "ok";
      } else {
        $this->data['data'] = [];
        $this->data['status'] = 404;
        $this->data['message'] = "Error Id";
      }
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    echo json_encode($this->data);
  }

  /**
   * The create function attempts to create a new entry using a model, returning the results or an error
   * message in JSON format.
   */
  public function create()
  {
    try {
      $results = $this->model->create($this->getDataModel());
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
        $results = $this->model->update($this->getDataModel(), $id);
        $this->data['data'] = $results;
        $this->data['status'] = 200;
        $this->data['message'] = "ok";
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
    echo json_encode($this->data);
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
        $results = $this->model->delete($id);
        $this->data['data'] = $results;
        $this->data['status'] = 200;
        $this->data['message'] = "ok";
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
    echo json_encode($this->data);
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
    $getModel['user_user'] = empty($data_request['user']) ? '' : $data_request['user'];
    $getModel['user_password'] = empty($data_request['password']) ? '' : $data_request['password'];
    $getModel['userStatus_fk'] = $data_request['status'];
    $getModel['role_fk'] = $data_request['role'];

    return $getModel;
  }
}
