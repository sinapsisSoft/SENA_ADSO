<?php

/**
 * Author:DIEGO CASALLAS
 * Date:22/05/2024
 * Descriptions:This is controller class for managing login
 * **/
//Is file namespace   
namespace App\Controllers;
//These are the class that will be used in this controller
use App\Models\LoginModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Message;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

//This is the user class
class Login extends Controller
{
  //Variable declarations. 
  private $loginModel;
  private $data;

  //This method is the constructor
  public function __construct()
  {
    $this->loginModel = new LoginModel();
    $this->data = [];
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "LOGIN";
    return view('login/login_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function logIn()
  {
    if ($this->request->isAJAX()) {
      $email = $this->request->getVar('User_user');
      $password = $this->request->getVar('User_password');
      $user = $this->loginModel->where('User_user', $email)->first();
      if (is_null($user)) {
        $this->$this->data['message'] = 'Invalid username.';
        $this->data['response'] = ResponseInterface::HTTP_UNAUTHORIZED;
        $this->data['data'] = '';
      }
      $pwd_verify = password_verify($password, $user['User_password']);
      if (!$pwd_verify) {
        $this->data['message'] = 'Invalid password.';
        $this->data['response'] = ResponseInterface::HTTP_UNAUTHORIZED;
        $this->data['data'] = '';
      } else {
        $session = session();
        $this->data['message'] = 'Login successful';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $user;
        $session->set(LOGGED_USER,$user);
      }
    } else {
      $this->data['message'] = 'Error Ajax';
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }
  //This method consists of single User  , obtains id the data from the GET method, return Json
  public function singOff()
  {
    if ($this->request->isAJAX()) {
      $session = session();
      $this->data['message'] = 'Login successful';
      $this->data['response'] = ResponseInterface::HTTP_OK;
      $this->data['data'] = "";
      $session->remove(LOGGED_USER);
    } else {
      $this->data['message'] = 'Error Ajax';
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }

  //This method consists of single User  , obtains id the data from the GET method, return Json
  public function forgerPassword()
  {
    try {
      if ($this->request->isAJAX()) {
        $email = $this->request->getVar('User_user');
        $user = $this->loginModel->where('User_user', $email)->first();
        if (is_null($user)) {
          $this->data['message'] = 'Invalid username.';
          $this->data['response'] = ResponseInterface::HTTP_UNAUTHORIZED;
          $this->data['data'] = '';
        } else {
          $this->data['message'] = 'Send Message Change Password';
          $this->data['response'] = ResponseInterface::HTTP_OK;
          $this->data['data'] = "";
        }
      } else {
        $this->data['message'] = 'Error Ajax';
        $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
        $this->data['data'] = '';
      }
    } catch (Exception $e) {
      $this->data['message'] = $e->getMessage();
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    return json_encode($this->data);
  }
}
