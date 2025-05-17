<?php
/**
 * Author:DIEGO CASALLAS
 * Date:14/05/2024
 * Descriptions:This is controller class for managing modules
 * **/
//Is file namespace   
namespace App\Controllers\Module;
//These are the class that will be used in this controller
use App\Models\Module\ModuleModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Role\RoleModulesModel;
use App\Models\Profile\ProfileModel;

//This is the class Module for managing modules
//This class is responsible for handling the CRUD operations for modules.
class Module extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $ModuleModel;
  private $profileModel;
  private $roleModuleModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Modules_id";
    $this->ModuleModel = new ModuleModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->profileModel = new ProfileModel();
    $this->data = [];
    $this->model = "modules";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "MODULES";
    $this->data[$this->model] = $this->ModuleModel->orderBy($this->primaryKey, 'ASC')->findAll();
    $this->data['modulesParent'] = $this->ModuleModel->where('Modules_submodule', 0)->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('module/modules_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->ModuleModel->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create user';
        $this->data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $this->data['data'] = '';
      }
    } else {
      $this->data['message'] = 'Error Ajax';
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }
  //This method consists of single User Status , obtains id the data from the GET method, return Json
  public function singleModule($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select user status model 
      if ($this->data[$this->model] = $this->ModuleModel->where($this->primaryKey, $id)->first()) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create user';
        $this->data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $this->data['data'] = '';
      }
    } else {
      $this->data['message'] = 'Error Ajax';
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }
  //This method consists of update status, obtains id the data from the POST method, return Json
  public function update()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = $this->getDataModel();
      $dataModel['updated_at'] = $today;
      //Update data model 
      if ($this->ModuleModel->update($id, $dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create user';
        $this->data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $this->data['data'] = '';
      }
    } else {
      $this->data['message'] = 'Error Ajax';
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }
  //This method consists of delete status, obtains id the data from the GET method, return Json
  public function delete($id = null)
  {
    try {
      //Delete data model 
      if ($this->ModuleModel->where($this->primaryKey, $id)->delete($id)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = "OK";
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error Ajax';
        $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
        $this->data['data'] = 'error';
      }
    } catch (\Exception $e) {
      $this->data['message'] = $e;
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }
  //This method consists of create is model the data in the array associative, return Array
  public function getDataModel()
  {
    $data = [
      'Modules_id' => $this->request->getVar('Modules_id'),
      'Modules_name' => $this->request->getVar('Modules_name'),
      'Modules_description' => $this->request->getVar('Modules_description'),
      'Modules_route' => $this->request->getVar('Modules_route'),
      'Modules_icon' => $this->request->getVar('Modules_icon'),
      'Modules_submodule' => $this->request->getVar('Modules_submodule'),
      'Modules_parent_module' => $this->request->getVar('Modules_parent_module'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }
}
