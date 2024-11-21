<?php

/**
 * Author:DIEGO CASALLAS
 * Date:08/11/2024
 * Descriptions: This is the class for the data model user functionality manager.
 */

namespace App\Models;

use App\Config\ConnectDB;
use Exception;
use PDO;

class UserModel
{
  /* These are private properties of the `UserModel` class in PHP. Here is a brief explanation of each
 property: */
  /* These are private properties of the `UserModel` class in PHP. Here is a brief explanation of each
 property: */
  private $conn;
  private $data;
  private $sql;
  private $pdo;
  private $modelData;
  private $primaryKey;

  /**
   * The constructor initializes variables for data storage and defines model data and primary key for a
   * PHP class.
   */
  public function __construct()
  {
    $this->data = [];
    $this->modelData = ['user_user', 'user_password', 'userStatus_fk', 'role_fk'];
    $this->primaryKey = 'user_id';
  }


/**
 * The function findAll() retrieves all user data either through a direct SQL query or by calling a
 * stored procedure and returns the results or an error message.
 * 
 * @return The `findAll` function is returning data fetched from the database table `user` or from a
 * stored procedure `sp_user_all()`. The data is fetched using PDO and returned as an associative
 * array. If an exception occurs during the execution, an empty array with a status code of 404 and an
 * error message will be returned.
 */
  public function findAll()
  {
    try {
      $this->conn = new ConnectDB();
      $this->pdo = $this->conn->connect();
      $this->sql = "SELECT * FROM user";
      $this->sql = "CALL sp_user_all()";
      $result = $this->pdo->prepare($this->sql);
      $result->execute();
      $results = $result->fetchAll(PDO::FETCH_ASSOC);
      $this->data = $results;
    } catch (Exception $e) {
      $this->data = [];
      $this->data['status'] = 404;
      $this->data['message'] = $e->getMessage();
    }
    return $this->data;
  }


 /**
  * The function `findId` retrieves a user's data from the database based on the provided ID.
  * 
  * @param int id The `findId` function you provided is a method that takes an integer `` as a
  * parameter and attempts to retrieve a user record from the database based on that ID. It connects to
  * the database, executes a SELECT query to fetch the user data, and returns the result as an
  * associative array
  * 
  * @return array An array containing data related to the user with the specified ID is being returned.
  * If the user is found, the array will contain the user's information fetched from the database. If
  * an error occurs during the process, the array will have an empty 'data' key, a status of 404, and
  * an error message explaining the issue.
  */
  public function findId(int $id): array
  {
    try {
      $this->conn = new ConnectDB();
      $this->pdo = $this->conn->connect();
      $this->sql = "SELECT * FROM user WHERE $this->primaryKey ={$id}";
      $result = $this->pdo->prepare($this->sql);
      $result->execute();
      $results = $result->fetchAll(PDO::FETCH_ASSOC);
      $this->data = $results;
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = $e->getMessage();
    }
    return $this->data;
  }

/**
 * This PHP function searches for user data using a stored procedure and returns the results or an
 * error message.
 * 
 * @param string data The `search` function you provided seems to be a method in a class that is
 * responsible for searching user data using a stored procedure `sp_user_search`. It takes a string
 * parameter `` which is used as input for the search query.
 * 
 * @return array The `search` function returns an array containing the search results fetched from the
 * database. If an exception occurs during the search process, it will return an array with an empty
 * 'data' key, a status of 404, and the error message in the 'message' key.
 */
  public function search(string $data): array
  {
    try {
   
      $this->conn = new ConnectDB();
      $this->pdo = $this->conn->connect();
      $this->sql = "CALL sp_user_search('".$data."');";

      $result = $this->pdo->prepare($this->sql);
      $result->execute();
      $results = $result->fetchAll(PDO::FETCH_ASSOC);
      $this->data = $results;
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * The function creates a new user record in a database table with hashed password and returns a
   * response based on validation and execution status.
   * 
   * @param array user The `create` function you provided seems to be a method for creating a new user
   * in a database. It takes an array `` as a parameter, which likely contains user data such as
   * username, password, user status, and role.
   * 
   * @return The `create` function is returning an array with keys `data`, `status`, and `message`. The
   * specific values of these keys depend on the outcome of the function execution. If the model data
   * passed in the `` array passes validation, a successful insertion into the database is
   * performed, and the `data` key is an empty array, `status` is set to 200, and
   */
  public function create(array $user): array
  {
    try {
      if ($this->validateModel($user)) {
        $this->conn = new ConnectDB();
        $this->pdo = $this->conn->connect();
        $this->sql = "INSERT INTO user(user_user, user_password,userStatus_fk,role_fk) VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($this->sql);
        $passwordHast = password_hash($user[$this->modelData[1]], PASSWORD_DEFAULT);
        $stmt->bindParam(1, $user[$this->modelData[0]]);
        $stmt->bindParam(2, $passwordHast);
        $stmt->bindParam(3, $user[$this->modelData[2]]);
        $stmt->bindParam(4, $user[$this->modelData[3]]);
        $stmt->execute();
        $last_id = $this->pdo->lastInsertId();
        $this->data['newId'] =  $last_id;
      } else {
        $this->data['data'] = [];
        $this->data['status'] = 404;
        $this->data['message'] = 'Error';
      }
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * This PHP function updates user data in a database table based on input array and user ID, handling
   * validation and error messages.
   * 
   * @param array user The `update` function you provided seems to be updating user data in a database.
   * It takes an array `` and an integer `` as parameters. The `` array likely contains data
   * related to the user that needs to be updated, such as `userStatus_fk` and `
   * @param int id The `id` parameter in the `update` function represents the unique identifier of the
   * user record that you want to update in the database. This identifier is used to locate the specific
   * user record that needs to be modified.
   * 
   * @return The `update` function returns an array with keys `data`, `status`, and `message`. The
   * specific values of these keys depend on the logic within the function. If the model data passed in
   * is validated successfully, it updates the user record in the database and sets `status` to 200 with
   * a message of 'OK'. If validation fails, it sets `status` to 404 with
   */
  public function update(array $user, int $id): array
  {
    try {
      if ($this->validateModel($user)) {
        $this->conn = new ConnectDB();
        $this->pdo = $this->conn->connect();
        $this->sql = "UPDATE user SET userStatus_fk=?,role_fk=? WHERE  $this->primaryKey=?";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(1, $user[$this->modelData[2]]);
        $stmt->bindParam(2, $user[$this->modelData[3]]);
        $stmt->bindParam(3, $id);
        $stmt->execute();
        $this->data['updateId'] = $id;
      } else {
        $this->data['data'] = [];
        $this->data['status'] = 404;
        $this->data['message'] = 'Error';
      }
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = $e->getMessage();
    }
    return $this->data;
  }

  /**
   * The function `delete` deletes a user record from the database based on the provided user ID.
   * 
   * @param int id The `delete` function you provided is a PHP method that deletes a user from a
   * database table based on the `user_id` provided as a parameter. The `id` parameter is the user ID
   * of the user you want to delete from the `user` table in the database.
   * 
   * @return The `delete` function returns an array with keys `data`, `status`, and `message`. The
   * `data` key contains an empty array, the `status` key contains either 200 if the deletion was
   * successful or 404 if there was an error, and the `message` key contains a message indicating the
   * status of the deletion operation.
   */
  public function delete(int $id): array
  {
    try {
      $this->conn = new ConnectDB();
      $this->pdo = $this->conn->connect();
      $this->sql = "DELETE FROM user WHERE  $this->primaryKey=?";
      $stmt = $this->pdo->prepare($this->sql);
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $this->data['deleteId'] = $id;
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = $e->getMessage();
    }
    return $this->data;
  }
  /**
   * The function `validateModel` checks if any values in the given array are empty based on
   * corresponding keys in the model data.
   * 
   * @param array It looks like there is a mistake in the code you provided. In the `validateModel`
   * function, you are using `` instead of `` to access the values. Here is the corrected
   * version of the function:
   * 
   * @return The function `validateModel` is returning a boolean value (`true` or `false`) based on the
   * validation logic inside the function.
   */
  private function validateModel($array): Bool
  {
    $validate = true;
    for ($i = 0; $i < count($array); $i++) {
      if (!empty($user[$this->modelData[$i]])) {
        $validate = false;
        break;
      }
    }
    return $validate;
  }
}
