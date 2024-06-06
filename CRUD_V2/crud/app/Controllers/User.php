<?php
/**
 * Author:DIEGO CASALLAS
 * Date:17/05/2024
 * Descriptions:This is controller class for managing user
 * **/
//Is file namespace   
namespace App\Controllers;
//These are the class that will be used in this controller
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\UserStatusModel;
use App\Models\ProfileModel;
use App\Models\RoleModulesModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the user class
class User extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $userModel;
  private $roleModel;
  private $roleModuleModel;
  private $profileModel;
  private $userStatusModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    
    $this->primaryKey = "User_id";
    $this->userModel = new UserModel();
    $this->roleModel = new RoleModel();
    $this->profileModel = new ProfileModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->userStatusModel = new UserStatusModel();
    $this->data = [];
 
    $this->model = "users";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "USERS";
    $this->data[$this->model] = $this->userModel->sp_users();
    $this->data['roles'] = $this->roleModel->orderBy('Roles_id', 'ASC')->findAll();
    $this->data['userStatus'] = $this->userStatusModel->orderBy('User_status_id', 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('user/users_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert Codeigniter
      if ($this->userModel->insert($dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error create user';
        $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $data['data'] = '';
      }
    } else {
      $data['message'] = 'Error Ajax';
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = '';
    }
    //Change array to Json
    echo json_encode($dataModel);
  }
  //This method consists of single User  , obtains id the data from the GET method, return Json
  public function singleUser($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select user  model 
      if ($data[$this->model] = $this->userModel->where($this->primaryKey, $id)->first()) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error create user';
        $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $data['data'] = '';
      }
    } else {
      $data['message'] = 'Error Ajax';
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = '';
    }
    //Change array to Json
    echo json_encode($data);
  }
  //This method consists of update , obtains id the data from the POST method, return Json
  public function update()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        'User_user' => $this->request->getVar('User_user'),
        'Roles_fk' => $this->request->getVar('Roles_fk'),
        'User_status_fk' => $this->request->getVar('User_status_fk'),
        'update_at' => $today
      ];
      //Update data model 
      if ($this->userModel->update($id, $dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error create user';
        $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $data['data'] = '';
      }
    } else {
      $data['message'] = 'Error Ajax';
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = '';
    }
    //Change array to Json
    echo json_encode($dataModel);
  }
  //This method consists of delete user, obtains id the data from the GET method, return Json
  public function delete($id = null)
  {
    try {
      //Delete data model 
      if ($this->userModel->where($this->primaryKey, $id)->delete($id)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = "OK";
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error Ajax';
        $data['response'] = ResponseInterface::HTTP_CONFLICT;
        $data['data'] = 'error';
      }
    } catch (\Exception $e) {
      $data['message'] = $e;
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = 'Error';
    }
    //Change array to Json
    echo json_encode($data);
  }
  //This method consists of create is model the data in the array associative, return Array
  public function getDataModel()
  {
    $data = [
      'User_id' => $this->request->getVar('User_id'),
      'User_user' => $this->request->getVar('User_user'),
      'User_password' => password_hash($this->request->getVar('User_password'),PASSWORD_DEFAULT),
      'Roles_fk' => $this->request->getVar('Roles_fk'),
      'User_status_fk' => $this->request->getVar('User_status_fk'),
      'update_at' => $this->request->getVar('update_at'),
    ];
    return $data;
  }
}
