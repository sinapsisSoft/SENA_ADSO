<?php
/**
 * Author:DIEGO CASALLAS
 * Date:17/05/2024
 * Descriptions:This is controller class for managing user
 * **/
//Is file namespace   
namespace App\Controllers\Student;
//These are the class that will be used in this controller
use App\Models\Student\StudentModel;
use App\Models\Student\StudentStatusModel;
use App\Models\DocumentTypes\DocumentTypesModel;
use App\Models\User\UserModel;
use App\Models\Role\RoleModulesModel;
use App\Models\Profile\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the user class
class Student extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $studentModel;
  private $studentStatusModel;
  private $userModel;
  private $documentTypesModel;
  private $profileModel;
  private $roleModuleModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  { 
    $this->primaryKey = "Student_id";
    $this->studentModel = new StudentModel();
    $this->studentStatusModel = new StudentStatusModel();
    $this->userModel = new UserModel();
    $this->documentTypesModel = new DocumentTypesModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->profileModel = new ProfileModel();
    $this->data = [];
    $this->model = "students";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "STUDENTS";
    $this->data[$this->model] = $this->studentModel->sp_students();
    $this->data['studentStatus'] = $this->studentStatusModel->orderBy('Student_status_id', 'ASC')->findAll();
    $this->data['documentType'] = $this->documentTypesModel->orderBy('Document_type_id', 'ASC')->findAll();
    $this->data['users'] = $this->userModel->sp_users_students_instructors();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('student/students_view', $this->data);
  }

  
  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->studentModel->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create student';
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
  public function singleStudent($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
 
      if ($this->data[$this->model] = $this->studentModel->sp_students_id($id)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error students';
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
      $dataModel['updated_at']=$today;
      //Update data model 
      if ($this->studentModel->update($id, $dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error update student';
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
      //Delete data model 
      if ($this->studentModel->where($this->primaryKey, $id)->delete($id)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = "OK";
        $this->data['csrf'] = csrf_hash();
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
  //This method consists of create is model the data in the array associative, return Array
  public function getDataModel()
  {
    
    $data = [
      'Student_id' => $this->request->getVar('Student_id'),
      'Student_document' => $this->request->getVar('Student_document'),
      'Student_first_name' => $this->request->getVar('Student_first_name'),
      'Student_last_name' => $this->request->getVar('Student_last_name'),
      'Student_phone' => $this->request->getVar('Student_phone'),
      'Student_email' => $this->request->getVar('Student_email'),
      'Student_address' => $this->request->getVar('Student_address'),
      'Student_birth_date' => $this->request->getVar('Student_birth_date'),
      'Student_gender' => $this->request->getVar('Student_gender'),
      'User_fk' => $this->request->getVar('User_fk'),
      'Document_type_fk' => $this->request->getVar('Document_type_fk'),
      'Student_status_fk' => $this->request->getVar('Student_status_fk'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }
}
