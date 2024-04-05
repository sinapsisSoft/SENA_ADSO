<?php
namespace App\Models\User;

use App\System\core\ConnectDB;
/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IModel
 * 
 */

class UserModel 
{
  //This attributes
  private $objConn;
  private $conn;
  private $sql;
  private $data;
  private $result;

  public function __construct()
  {
    $this->objConn = new ConnectDB();
    $this->conn = null;
    $this->sql = "";
    $this->data = array();
    $this->result = array();
  }

  public function spCreate(array $data)
  {
    try {
    } catch (\Exception $e) {
    }
  }
  public function spUpdate(array $data)
  {
  }
  public function spEdit(int $id)
  {
  }
  public function spDelete(int $id)
  {
  }
  /**
   * Author:DIEGO CASALLAS
   * Date:27/02/2024
   * Update Date:
   * Descriptions:This method shows all registered users
   * 
   */
  public function getUsers()
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
  public function spShowId(int $id)
  {
    try {
      $this->conn =  $this->objConn->Connected();
      $this->sql = "CALL sp_select_id_user(" . $id . ")";
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
  public function spGetData(string $data)
  {
  }
}
