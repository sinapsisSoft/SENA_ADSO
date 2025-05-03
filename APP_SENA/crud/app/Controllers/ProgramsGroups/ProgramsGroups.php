<?php
/**
 * Author:DIEGO CASALLAS
 * Date:29/05/2024
 * Descriptions:This is controller class for managing Programs Groups
 * **/
//Is file namespace   
namespace App\Controllers\ProgramsGroups;
//These are the class that will be used in this controller
use App\Models\ProgramsGroups\ProgramsGroupsModel;
use App\Models\ProgramsGroups\ProgramsGroupStudentModel;
use App\Models\Student\StudentModel;
use App\Models\Role\RoleModulesModel;
use App\Models\Profile\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the user class
class ProgramsGroups extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $programsGroupsModel;
  private $programsGroupStudentModel;
  private $studentModel;
  private $profileModel;
  private $roleModuleModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  { 
    $this->primaryKey = "Program_group_id";
    $this->programsGroupsModel = new ProgramsGroupsModel();
    $this->programsGroupStudentModel = new ProgramsGroupStudentModel();
    $this->studentModel = new StudentModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->profileModel = new ProfileModel();
    $this->data = [];
    $this->model = "programGroups";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "PROGRAMS GROUPS";
    $this->data[$this->model] = $this->programsGroupsModel->orderBy($this->primaryKey, 'ASC')->findAll();
    $this->data['students'] = $this->studentModel->sp_students_group();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('programsGroups/programsGroups_view', $this->data);
  }
  
  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->programsGroupsModel->insert($dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error create program group';
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
  //This method consists of single Students  , obtains id the data from the GET method, return Json
  public function singleProgramsGroups($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($data[$this->model] = $this->programsGroupsModel->where($this->primaryKey, $id)->first()) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error Program Group';
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
      $dataModel = $this->getDataModel();
      $dataModel['updated_at']=$today;
      //Update data model 
      if ($this->programsGroupsModel->update($id, $dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error update Program group';
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
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($data[$this->model] = $this->programsGroupsModel->where($this->primaryKey, $id)->first()) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error Program Group';
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
   //This method consists of delete user, obtains id the data from the GET method, return Json
   public function addStudent()
   {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataGroupModel();
      //Query Insert 
      if ($this->programsGroupStudentModel->insert($dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
     } else {
        $data['message'] = 'Error create program group';
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
    //This method consists of update , obtains id the data from the POST method, return Json
  public function getStudentGroups()
  {
     //Validate is ajax
     if ($this->request->isAJAX()) {
      //Select student  model 
      if ($data[$this->model] = $this->studentModel->sp_students_group()) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error Program Group';
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
    
    $data = [
      'Program_group_id' => $this->request->getVar('Program_group_id'),
      'Program_group_code' => $this->request->getVar('Program_group_code'),
      'Program_group_start_date' => $this->request->getVar('Program_group_start_date'),
      'Program_group_end_date' => $this->request->getVar('Program_group_end_date'),
      'Program_group_status' => $this->request->getVar('Program_group_status'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }
  //This method consists of create is model the data in the array associative, return Array
  public function getDataGroupModel()
  {
    
    $data = [
      'Program_group_fk' => $this->request->getVar('group_id'),
      'Student_fk' => $this->request->getVar('student_id')
    ];
    return $data;
  }
}
