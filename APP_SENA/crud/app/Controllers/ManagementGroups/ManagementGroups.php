<?php

/**
 * Author:DIEGO CASALLAS
 * Date:03/05/2024
 * Descriptions:This is controller class for managing Programs Groups
 * **/
//Is file namespace   
namespace App\Controllers\ManagementGroups;
//These are the class that will be used in this controller
use App\Models\ManagementGroups\ManagementGroupsModel;
use App\Models\ProgramsGroups\ProgramsGroupsModel;
use App\Models\Student\StudentModel;
use App\Models\Role\RoleModulesModel;
use App\Models\Profile\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the user class
class ManagementGroups extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $managementGroupsModel;
  private $programsGroupsModel;
  private $studentModel;
  private $profileModel;
  private $roleModuleModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Management_group_id";
    $this->managementGroupsModel = new ManagementGroupsModel();
    $this->programsGroupsModel = new ProgramsGroupsModel();
    $this->studentModel = new StudentModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->profileModel = new ProfileModel();
    $this->data = [];
    $this->model = "managementGroup";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index($id)
  {
    $this->data['title'] = "MANAGEMENT GROUPS";
    $this->data[$this->model] = $this->managementGroupsModel->sp_management_group($id);
    $this->data['programGroup'] = $this->programsGroupsModel->where('Program_group_id', $id)->first();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('managementGroups/management_groups_view', $this->data);
  }


  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->managementGroupsModel->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create program group';
        $this->data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $this->data['data'] = "";
      }
    } else {
      $this->data['message'] = 'Error Ajax';
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }
  //This method consists of single Students  , obtains id the data from the GET method, return Json
  public function singleProgramsGroups($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($this->data[$this->model] = $this->managementGroupsModel->where($this->primaryKey, $id)->first()) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error Program Group';
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
  //This method consists of update , obtains id the data from the POST method, return Json
  public function update()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = $this->getDataModel();
      $dataModel['updated_at'] = $today;
      //Update data model 
      if ($this->managementGroupsModel->update($id, $dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error update Program group';
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
  //This method consists of delete user, obtains id the data from the GET method, return Json
  public function delete($id = null)
  {
    try {
      if ($this->request->isAJAX()) {
        //Select student  model 
        if ($this->managementGroupsModel->where($this->primaryKey, $id)->delete($id)) {
          $this->data['message'] = 'success';
          $this->data['response'] = ResponseInterface::HTTP_OK;
          $this->data['data'] = "OK";
          $this->data['csrf'] = csrf_hash();
        } else {
          $this->data['message'] = 'Error Ajax';
          $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
          $this->data['data'] = 'error';
        }
      } else {
        $this->data['message'] = 'Error Ajax';
        $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
        $this->data['data'] = '';
      }
    } catch (\Exception $e) {
      $this->data['message'] = $e;
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = 'Error';
    }
    //Change array to Json
    echo json_encode($this->data);
  }


  //This method consists of single User Status , obtains id the data from the GET method, return Json
  public function singleManagementGroups($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select user status model 
      if ($data[$this->model] = $this->managementGroupsModel->where($this->primaryKey, $id)->first()) {
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
  //This method consists of create is model the data in the array associative, return Array
  public function getDataModel()
  {

    return [
      'Management_group_id' => $this->request->getVar('Management_group_id'),
      'Management_group_position' => $this->request->getVar('Management_group_position'),
      'Management_group_name' => $this->request->getVar('Management_group_name'),
      'Management_group_start_date' => $this->request->getVar('Management_group_start_date'),
      'Management_group_end_date' => $this->request->getVar('Management_group_end_date'),
      'Program_group_fk' => $this->request->getVar('Program_group_fk'),
      'Management_group_status' => $this->request->getVar('Management_group_status'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
  }
}
