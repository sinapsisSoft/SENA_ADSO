<?php

/**
 * Author:DIEGO CASALLAS
 * Date:21/11/2024
 * Descriptions: This is the Login user class controller access applications data model
 */

namespace App\Controllers;

use App\Models\LoginModel;
use App\Config\View;

use Exception;

class LoginController
{
  private $data;
  private $model;
  private $result;


  public function __construct()
  {
    $this->data = [];
    $this->model = new LoginModel();
    $this->result = "";
  }


  public function index()
  {
    try {

      $view = new View('login/index');
      $view->set('title', 'Login Index');
      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    //echo json_encode($this->data);
  }
  public function logIn()
  {
    try {
      $headerRoute="";
      $this->result = $this->model->validateUser($this->getDataModel());
      if (count($this->result['logIn']) > 0) {

        $hash = $this->result['logIn'][0]['user_password'];

        if (password_verify($this->result['password'], $hash)) {
          $this->data['data'] = [];
          $this->data['status'] = 200;
          $this->data['message'] = "Password is valid!";
          session_start();
          $_SESSION[SESSION_APP]=$this->result['logIn'];
          $headerRoute=URL_CONTROLLER.'/home/dashboard';
        } else {
          $this->data['data'] = [];
          $this->data['status'] = 404;
          $this->data['message'] = "Error: Invalid password";
          session_start();
          $_SESSION["message"]="Error: Invalid password";
          $headerRoute=URL_CONTROLLER.'/login/index';
        }
      } else {
        $this->data['data'] = [];
        $this->data['status'] = 404;
        $this->data['message'] = "Error: Unregistered user";
        session_start();
        $_SESSION["message"]="Error: Unregistered use";

        $headerRoute=URL_CONTROLLER.'/login/index';      }
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
      $headerRoute=URL_CONTROLLER.'/login/index';
    }
 
    header('Location: '   .$headerRoute);
    echo json_encode($this->data);
  }

  public function logOut()
  {
    try {
  
      session_destroy();

    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    header('Location: '   .URL_CONTROLLER.'/login/index');
    echo json_encode($this->data);
  }
  public function viewLostPassword()
  {
    try {

      $view = new View('login/lostPassword');
      $view->set('title', 'Lost Password');

      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    //echo json_encode($this->data);
  }
  public function viewPasswordChange()
  {
    try {

      $view = new View('login/changesPassword');
      $view->set('title', 'Lost Password');

      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
    //echo json_encode($this->data);
  }

  private function getDataModel()
  {
    $data_request = json_decode(file_get_contents('php://input'), true);

    if ($data_request != NULL) {
      $getModel['user_user'] = empty($data_request['user']) ? '' : $data_request['user'];
      $getModel['user_password'] = empty($data_request['password']) ? '' : $data_request['password'];
    } else {
      $getModel['user_user'] = empty($_REQUEST['user']) ? '' : $_REQUEST['user'];
      $getModel['user_password'] = empty($_REQUEST['password']) ? '' : $_REQUEST['password'];
    }

    return $getModel;
  }
}
