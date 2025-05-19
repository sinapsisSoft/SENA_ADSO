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
use App\Models\ProgramsGroups\ProgramsGroupInstructorModel;
use App\Models\Student\StudentModel;
use App\Models\Instructor\InstructorModel;
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
  private $ProgramsGroupInstructorModel;
  private $studentModel;
  private $instructorModel;
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
    $this->ProgramsGroupInstructorModel = new ProgramsGroupInstructorModel();
    $this->studentModel = new StudentModel();
    $this->instructorModel = new InstructorModel();
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
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create program group';
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
  //This method consists of single Students  , obtains id the data from the GET method, return Json
  public function singleProgramsGroups($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($this->data[$this->model] = $this->programsGroupsModel->where($this->primaryKey, $id)->first()) {
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
      if ($this->programsGroupsModel->update($id, $dataModel)) {
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
  public function delete($id = null) {}
  //This method consists of delete user, obtains id the data from the GET method, return Json
  public function addStudent()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataGroupModel('students');
      //Query Insert 
      if ($this->programsGroupStudentModel->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data[$this->model] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error add students program group';
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
  public function addInstructor()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataGroupModel('instructors');
      //Query Insert 
      if ($this->ProgramsGroupInstructorModel->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error add instructor program group';
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
  public function removeInstructor($id = null)
  {
    try {
      //Remove instructor group 
      if ($this->request->isAJAX()) {
        if ($this->ProgramsGroupInstructorModel->sp_remove_instructor_group($id)) {
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
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }
  public function removeStudent($id = null)
  {
    try {
      //Remove instructor group 
      if ($this->request->isAJAX()) {
        
        if ($this->programsGroupStudentModel->sp_remove_student_group($id)) {
          $this->data['message'] = 'success';
          $this->data['response'] = ResponseInterface::HTTP_OK;
          $this->data['data'] = "OK";
          $this->data['csrf'] = csrf_hash();
        } else {
          $this->data['message'] = 'Error remove student group';
          $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
          $this->data['data'] = '';
        }
      } else {
        $this->data['message'] = 'Error Ajax';
        $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
        $this->data['data'] = '';
      }
    } catch (\Exception $e) {
      $this->data['message'] = $e;
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode($this->data);
  }

  public function getStudentNoGroups()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($this->data[$this->model] = $this->studentModel->sp_students_no_group()) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error get students Group';
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
  public function getStudentGroups($id)
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($this->data[$this->model] = $this->studentModel->sp_students_group($id)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error get students Group';
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
  public function getInstructorGroups($id)
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select instructor  model 
      if ($this->data[$this->model] = $this->instructorModel->sp_instructs_group($id)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error get Instructors Group';
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
  public function getInstructorNoGroups()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select instructor  model 
      if ($this->data[$this->model] = $this->instructorModel->sp_instructs_no_group()) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error get Instructors Group';
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
  public function getDataGroupModel($type)
  {
    if ($type == "students") {
      $data = [
        'Program_group_fk' => $this->request->getVar('group_id'),
        'Student_fk' => $this->request->getVar('student_id')
      ];
    } else {
      $data = [
        'Program_group_fk' => $this->request->getVar('group_id'),
        'Instructor_fk' => $this->request->getVar('instructor_id')
      ];
    }
    return $data;
  }
}
