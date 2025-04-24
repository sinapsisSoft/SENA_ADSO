<?php
/**
 * Author:DIEGO CASALLAS
 * Date:15/05/2024
 * Descriptions:This is controller class for managing permissions
 * **/
//Is file namespace   
namespace App\Controllers;
//These are the class that will be used in this controller
use App\Models\PermissionModel;
use App\Models\ProfileModel;
use App\Models\RoleModulesModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the permission model class
class Permission extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $PermissionModel;
  private $roleModuleModel;
  private $profileModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Permissions_id";
    $this->PermissionModel = new PermissionModel();
    $this->profileModel = new ProfileModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->data = [];
    $this->model = "permissions";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "PERMISSIONS";
    $this->data[$this->model] = $this->PermissionModel->orderBy($this->primaryKey, 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('permission/permission_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert Codeigniter
      if ($this->PermissionModel->insert($dataModel)) {
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
  //This method consists of single User permission , obtains id the data from the GET method, return Json
  public function singlePermission($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select user permission model 
      if ($data[$this->model] = $this->PermissionModel->where($this->primaryKey, $id)->first()) {
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
  //This method consists of update permission, obtains id the data from the POST method, return Json
  public function update()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        'Permissions_name' => $this->request->getVar('Permissions_name'),
        'Permissions_description' => $this->request->getVar('Permissions_description'),
        'Permissions_icon' => $this->request->getVar('Permissions_icon'),
        'update_at' => $today
      ];
      //Update data model 
      if ($this->PermissionModel->update($id, $dataModel)) {
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
  //This method consists of delete permission, obtains id the data from the GET method, return Json
  public function delete($id = null)
  {
    try {
      //Delete data model 
      if ($this->PermissionModel->where($this->primaryKey, $id)->delete($id)) {
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
      'Permissions_id' => $this->request->getVar('Permissions_id'),
      'Permissions_name' => $this->request->getVar('Permissions_name'),
      'Permissions_description' => $this->request->getVar('Permissions_description'),
      'Permissions_icon' => $this->request->getVar('Permissions_icon'),
      'update_at' => $this->request->getVar('update_at'),
    ];
    return $data;
  }
  
}
