<?php

namespace App\Controllers;

use App\Config\ConnectDB;
use PDO;

class UserController
{
  private $connDB;
  private $pdo;
  private $data;

  public function __construct()
  {
    $this->data = [];
  }

  public function index($parameters = Null)
  {
    echo ("User Index" . $parameters);
  }
  public function show($parameter = Null)
  {
    $this->connDB = new ConnectDB();
    $this->pdo = $this->connDB->connect();
    $sql = "SELECT * FROM user";
    $result = $this->pdo->prepare($sql);
    $result->execute();
    $results = $result->fetchAll(PDO::FETCH_ASSOC);
    $this->data['data'] = $results;
    //var_dump($this->data['data']);
    //echo("User Index".$parameters);

    echo json_encode($this->data);
  }
  public function showId($parameter = Null)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if ($parameter != "") {
        echo ($parameter);
        $this->connDB = new ConnectDB();
        $this->pdo = $this->connDB->connect();
        $sql = "SELECT * FROM user WHERE user_id={$parameter}";
        $result = $this->pdo->prepare($sql);
        $result->execute();
        $results = $result->fetchAll(PDO::FETCH_ASSOC);
        $this->data['data'] = $results;
        $this->data['status'] = 200;
        $this->data['message'] = "ok";
      } else {
        $this->data['data'] = [];
        $this->data['status'] = 404;
        $this->data['message'] = "error";
      }
      
    }else{
      $this->data['data'] = [];
        $this->data['status'] = 404;
        $this->data['message'] = "Method not validated";
    }
    echo json_encode($this->data);
  }
  public function create($parameter = Null)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name=$_POST['name'];
      $this->data['data'] = $name;
    }else{
      $this->data['data'] = [];
        $this->data['status'] = 404;
        $this->data['message'] = "Method not validated";
    }
    echo json_encode($this->data);
  }
}
