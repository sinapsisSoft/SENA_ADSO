<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IController
 * 
 */

namespace App\Controllers\Login;


use App\Models\User\UserModel;
use App\Config\View;

class LoginController
{
  private $userModel;
  private $UserPassword;
  private $data;
  private $view;

  public function __construct()
  {
    $this->userModel = new UserModel();
    $this->UserPassword = "User_password";
    $this->data = [];
    $this->view = new View();
  }

  public function login()
  {
    try {
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $getData = $this->getDataModel();
        $pass = $getData[$this->UserPassword];
        $hash = $this->userModel->spLogin($getData);
        if (!empty($hash)) {
          if (password_verify($pass,  $hash[0])) {
            $this->data["data"] = "Ok";
          } else {
            $this->data["data"] = "Error password";
          }
        }else{
          $this->data["data"] = "Error user";  
        }
      } else {
        $this->data["error"] = "NOT REQUEST_METHOD GET - PUT - DELETE";
      }
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    echo (json_encode($this->data));
  }


  public function show()
  {
    $this->data['title'] = "LOGIN";
    $this->view->render('login/login', $this->data);
  }


  public function getDataModel()
  {
    try {
      $jsonData = file_get_contents('php://input');
      $data = json_decode($jsonData, true);
      $_REQUEST = $data;
      $getDataRequest = [];
      $getDataRequest['User_user'] = "'" . $_REQUEST['User_user'] . "'";
      $getDataRequest['User_password'] = $_REQUEST['User_password'];
    } catch (\Exception $e) {
    }
    return $getDataRequest;
  }
}
