<?php

/**
 * Author:DIEGO CASALLAS
 * Date:22/11/2024
 * Descriptions: This is the class for the data model login functionality manager.
 */

namespace App\Models;

use App\Config\ConnectDB;
use Exception;
use PDO;

class LoginModel
{

  private $conn;
  private $data;
  private $sql;
  private $pdo;
  private $modelData;
  private $userKey;


  public function __construct()
  {
    $this->data = [];
    $this->modelData = ['user_user', 'user_password'];
    $this->userKey = 'user_user';
  }




  public function validateUser(array $user): array
  {
   
    try {
      if ($this->validateModel($user)) {
        $this->conn = new ConnectDB();
        $this->pdo = $this->conn->connect();
        $this->sql = "SELECT * FROM user WHERE userStatus_fk=1 AND $this->userKey=?";
        $stmt = $this->pdo->prepare($this->sql);

        $stmt->bindParam(1, $user[$this->modelData[0]]);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->data['logIn'] = $results;
        $this->data['password'] = $user[$this->modelData[1]];
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
