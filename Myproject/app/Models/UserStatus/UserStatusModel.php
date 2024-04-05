<?php

/**
 * Author:MAIRA MEDINA
 * Date:15/02/2024
 * Update Date:
 * Descriptions: this is class model role
 * 
 */

 namespace App\Models\UserStatus;

 use App\System\core\ConnectDB;

class UserStatusModel
{
  private $data;
  private $sql;
  private $conn;
  public function __construct()
  {
    $this->conn = new ConnectDB();
    $this->data = array();
  }
  public function getUserStatus()
  {
    try {
      $this->sql = "SELECT * FROM user_status";
      $getConn = $this->conn->Connected();
      $result =  $getConn->query($this->sql);
      while ($row = $result->fetch_assoc()) {
        $this->data[] = $row;
      }
      $result->free_result();
    } catch (\Exception $e) {
      echo ("Error: " . $e->getMessage());
    }

    $this->conn->Close();

    return ($this->data);
  }
}
