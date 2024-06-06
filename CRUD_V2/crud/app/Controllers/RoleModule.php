<?php
/**
 * Author:DIEGO CASALLAS
 * Date:17/05/2024
 * Descriptions:This is controller class for managing roleModule
 * **/
//Is file namespace   
namespace App\Controllers;
//These are the class that will be used in this controller
use App\Models\RoleModulesModel;
use App\Models\ModuleModel;
use App\Models\PermissionModel;
use App\Models\ProfileModel;
use App\Models\RoleModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the roleModules class
class RoleModule extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $roleModuleModel;
  private $moduleModel;
  private $roleModel;
  private $permissionModel;
  private $profileModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "RoleModules_id";
    $this->roleModuleModel = new RoleModulesModel();
    $this->moduleModel = new ModuleModel();
    $this->roleModel = new RoleModel();
    $this->profileModel = new ProfileModel();
    $this->permissionModel = new PermissionModel();
    $this->data = [];
    $this->model = "roleModules";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "ROLE MODULES";
    $this->data['titlePermissions'] = "MODULE PERMISSIONS";
    $this->data[$this->model] = $this->roleModuleModel->sp_role_modules();
    $this->data['roles'] = $this->roleModel->orderBy('Roles_id', 'ASC')->findAll();
    $this->data['modules'] = $this->moduleModel->orderBy('Modules_id', 'ASC')->findAll();
    $this->data['permissions'] = $this->permissionModel->orderBy('Permissions_id', 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('roleModule/roleModules_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert Codeigniter
      if ($this->roleModuleModel->insert($dataModel)) {
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
  //This method consists of single User Status , obtains id the data from the GET method, return Json
  public function singleRoleModule($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select user status model 
      if ($data[$this->model] = $this->roleModuleModel->where($this->primaryKey, $id)->first()) {
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
    //This method consists of single User Status , obtains id the data from the GET method, return Json
    public function singleRoleModuleId($id = null)
    {    //Validate is ajax
      if ($this->request->isAJAX()) {
        //Select user status model 
        if ($data[$this->model] = $this->roleModuleModel->sp_role_module_id($id)) {
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
      //This method consists of single User Status , obtains id the data from the GET method, return Json
      public function singlePermissionsModuleId($id = null)
      {    //Validate is ajax
        if ($this->request->isAJAX()) {
          //Select user status model 
          if ($data[$this->model] = $this->roleModuleModel->sp_permissions_module_id($id)) {
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
  //This method consists of update status, obtains id the data from the POST method, return Json
  public function update()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        'Modules_fk' => $this->request->getVar('Modules_fk'),
        'Roles_fk' => $this->request->getVar('Roles_fk'),
        'update_at' => $today
      ];
      //Update data model 
      if ($this->roleModuleModel->update($id, $dataModel)) {
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
  //This method consists of delete status, obtains id the data from the GET method, return Json
  public function delete($id = null)
  {
    try {
      //Delete data model 
      if ($this->roleModuleModel->where($this->primaryKey, $id)->delete($id)) {
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
      'RoleModules_id' => $this->request->getVar('RoleModules_id'),
      'Modules_fk' => $this->request->getVar('Modules_fk'),
      'Roles_fk' => $this->request->getVar('Roles_fk'),
      'update_at' => $this->request->getVar('update_at'),
    ];
    return $data;
  }
}
