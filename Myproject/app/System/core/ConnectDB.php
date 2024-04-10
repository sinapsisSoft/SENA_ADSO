<?php

namespace App\System\core;

/**
 * Author:MAIRA MEDINA
 * Date:15/02/2024
 * Update Date:
 * Descriptions: this is class connected
 * 
 */
class ConnectDB
{
  private $host;
  private $user;
  private $password;
  private $myDB;
  private $mysqli;
  public function __construct()
  {
    $this->host = "localhost";
    $this->user = "root";
    $this->password = "";
    $this->myDB = "apiSENA";
    $this->mysqli = null;
  }
  public function Connected()
  {
    try {

      $this->mysqli = new \mysqli($this->host, $this->user, $this->password, $this->myDB);

      if ($this->mysqli->connect_error) {
        echo ("Faild to connect " . $this->mysqli->connect_error);
      } else {
       // echo ("Connected ... </br>");
      }
    } catch (\Exception $e) {
      echo ("error: " . $e);
    }
    return $this->mysqli;
  }
  public function Close()
  {
    try {
      $this->mysqli->close();
    } catch (\Exception $e) {
      echo ("error: " . $e);
    }
  }
}
