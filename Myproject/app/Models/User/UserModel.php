<?php

namespace App\Models\User;

use App\System\core\ConnectDB;
use App\System\interface\IModel;

/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IModel
 * 
 */
class UserModel implements IModel
{
  //This attributes
  private $objConn;
  private $conn;
  private $sql;
  private $data;
  private $result;
  private $model;

  /**
   * The function initializes variables for database connection and data manipulation in a PHP class.
   */
  public function __construct()
  {
    $this->objConn = new ConnectDB();
    $this->conn = null;
    $this->sql = "";
    $this->data = array();
    $this->result = array();
    $this->model = ['User_id', 'User_user', 'User_password', 'User_status_id', 'Role_id'];
  }

  /**
   * The function spCreate in PHP attempts to insert user data into a database using a stored procedure
   * and returns the result or an error message.
   * 
   * @param array data The `spCreate` function you provided seems to be a method for creating a user by
   * calling a stored procedure `sp_insert_user` with the data provided in the `` array.
   * 
   * @return The `spCreate` function is returning the data fetched from the database after executing the
   * stored procedure `sp_insert_user`. If an exception occurs during the execution, the error message is
   * returned instead.
   */
  public function spCreate(array $data)
  {
    try {
      $this->conn =  $this->objConn->Connected();
      $this->sql = 'CALL sp_insert_user(' . $data[$this->model[1]] . ',' . $data[$this->model[2]] . ',' . $data[$this->model[3]] . ',' . $data[$this->model[4]] . ')';
      $this->result = $this->conn->query($this->sql);
      $this->data =  $this->result->fetch_all()[0];
      $this->result->free_result();
      $this->conn->Close();
    } catch (\Exception $e) {
      $this->data = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * This PHP function spUpdate takes an array of data, connects to a database, calls a stored procedure
   * to update user information, and returns the result or an error message.
   * 
   * @param array data The `spUpdate` function seems to be updating user information using a stored
   * procedure `sp_update_user`. The function takes an array `` as input, which likely contains user
   * data to be updated.
   * 
   * @return The function `spUpdate` will return the data fetched from the database after executing the
   * stored procedure `sp_update_user`. If an exception occurs during the execution, the function will
   * return the error message.
   */
  public function spUpdate(array $data)
  {
    try {
      $this->conn =  $this->objConn->Connected();
      $this->sql = 'CALL sp_update_user(' . $data[$this->model[0]] . ',' . $data[$this->model[3]] . ',' . $data[$this->model[4]] . ')';
      $this->result = $this->conn->query($this->sql);
      $this->data =  $this->result->fetch_all()[0];
      $this->result->free_result();
      $this->conn->Close();
    } catch (\Exception $e) {
      $this->data = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * This PHP function executes a stored procedure to delete a user based on the provided data array.
   * 
   * @param array data The `spDelete` function takes an array `` as a parameter. The function
   * attempts to delete a user by calling a stored procedure `sp_delete_user` with the user ID provided
   * in the `` array.
   * 
   * @return The function `spDelete` is returning the data fetched from the database after executing the
   * stored procedure `sp_delete_user` with the input parameter provided in the `` array. If the
   * operation is successful, it returns the fetched data. If an exception occurs during the process, it
   * catches the exception and returns the error message.
   */
  public function spDelete(array $data)
  {
    try {
      $this->conn =  $this->objConn->Connected();
      $this->sql = 'CALL sp_delete_user(' . $data[$this->model[0]] . ')';
      $this->result = $this->conn->query($this->sql);
      $this->data =  $this->result->fetch_all()[0];
      $this->result->free_result();
      $this->conn->Close();
    } catch (\Exception $e) {
      $this->data = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * The function `spShow` executes a stored procedure to select all users from a database and returns
   * the result as an array.
   * 
   * @return The `spShow` function is returning the data fetched from the database using the stored
   * procedure `sp_select_all_users()`. If the database operation is successful, it returns an array of
   * rows fetched from the database. If there is an exception thrown during the database operation, it
   * returns the error message.
   */

  public function spShow()
  {
    try {
      $this->conn =  $this->objConn->Connected();
      $this->sql = "CALL sp_select_all_users()";
      $this->result = $this->conn->query($this->sql);
      $getRow = [];
      while ($row = $this->result->fetch_assoc()) {
        array_push($getRow, $row);
      }
      $this->result->free_result();
      $this->conn->Close();
      $this->data = $getRow;
    } catch (\Exception $e) {
      $this->data = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * Author:DIEGO CASALLAS
   * Date:27/02/2024
   * Update Date:
   * Descriptions:This method shows id user registered user
   * 
   */

  /**
   * This PHP function retrieves user data by calling a stored procedure with a specified ID from the
   * database.
   * 
   * @param array data The `spShowId` function takes an array `` as a parameter. The function then
   * attempts to establish a database connection, execute a stored procedure `sp_select_id_user` with the
   * value from `[->model[0]]`, fetch the results, store them in an array
   * 
   * @return The function `spShowId` returns the data fetched from the database using the stored
   * procedure `sp_select_id_user` with the input parameter provided in the `` array. If the data
   * retrieval is successful, an array of rows fetched from the database is returned. If an exception
   * occurs during the process, the error message is returned instead.
   */
  public function spShowId(array $data)
  {
    try {
      $this->conn =  $this->objConn->Connected();
      $this->sql = 'CALL sp_select_id_user(' . $data[$this->model[0]] . ')';
      $this->result = $this->conn->query($this->sql);
      $getRow = [];
      while ($row = $this->result->fetch_assoc()) {
        array_push($getRow, $row);
      }
      $this->result->free_result();
      $this->conn->Close();
      $this->data = $getRow;
    } catch (\Exception $e) {
      $this->data = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * The spGetData function in PHP takes a string parameter and does not return any value.
   * 
   * @param string data The `spGetData` function takes a single parameter `` of type string. This
   * parameter is used to pass data to the function for processing or manipulation.
   */
  public function spGetData(string $data)
  {
  }
}
