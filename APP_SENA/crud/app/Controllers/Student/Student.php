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
use App\Models\DocumentTypes\DocumentTypesModel;
use App\Models\User\UserModel;
use App\Models\Role\RoleModulesModel;
use App\Models\User\UserStatusModel;
use App\Models\Profile\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the user class
class Student extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $studentModel;
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
      //Query Insert Codeigniter
      if ($this->studentModel->insert($dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error create student';
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
  public function singleStudent($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($data[$this->model] = $this->studentModel->where($this->primaryKey, $id)->first()) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error students';
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
        'updated_at' => $today
      ];
      //Update data model 
      if ($this->studentModel->update($id, $dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error update user';
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
      if ($this->studentModel->where($this->primaryKey, $id)->delete($id)) {
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
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }
}
