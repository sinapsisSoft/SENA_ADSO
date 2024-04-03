<?php

/**
 * Author:MAIRA MEDINA
 * Date:15/02/2024
 * Update Date:
 * Descriptions: this is class model role
 * 
 */

namespace App\Models\Role;
use App\System\core\ConnectDB;
// 
class RoleModel
{
  private $data;
  private $sql;
  private $conn;
  public function __construct()
  {
    $this->conn = new ConnectDB();
    $this->data = array();
  }
  public function  GetModelRoles()
  {
    try {
      $this->sql = "SELECT * FROM role ";
      $getConn = $this->conn->Connected();
      $result =  $getConn->query($this->sql);

      while ($row = $result->fetch_assoc()) {
        $this->data[] = $row;
      }
      $result->free_result();
    } catch (Exception $e) {
      echo ("Error: " . $e->getMessage());
    }

    $this->conn->Close();

    return ($this->data);
  }
}
// $obj=new RoleModel();
// $obj->GetRoles();