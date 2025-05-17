<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/04/2025
 * Descriptions:This is controller class for managing user
 * **/
//Is file namespace   
namespace App\Controllers\Instructor;
//These are the class that will be used in this controller
use App\Models\Instructor\InstructorModel;
use App\Models\DocumentTypes\DocumentTypesModel;
use App\Models\Specialty\SpecialtyModel;
use App\Models\User\UserModel;
use App\Models\User\UserStatusModel;
use App\Models\Role\RoleModulesModel;
use App\Models\Profile\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the Instructor class
class Instructor extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $instructorModel;
  private $userModel;
  private $userStatusModel;
  private $documentTypesModel;
  private $profileModel;
  private $specialtyModel;
  private $roleModuleModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Instructor_id";
    $this->instructorModel = new InstructorModel();
    $this->userModel = new UserModel();
    $this->userStatusModel = new UserStatusModel();
    $this->documentTypesModel = new DocumentTypesModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->profileModel = new ProfileModel();
    $this->specialtyModel = new SpecialtyModel();
    $this->data = [];
    $this->model = "instructors";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "INSTRUCTORS";
    $this->data[$this->model] = $this->instructorModel->sp_instructors();
    $this->data['users'] = $this->userModel->sp_users_students_instructors();
    $this->data['userStatus'] = $this->userStatusModel->orderBy('User_status_id', 'ASC')->findAll();
    $this->data['documentType'] = $this->documentTypesModel->orderBy('Document_type_id', 'ASC')->findAll();
    $this->data['specialties'] = $this->specialtyModel->orderBy('Specialty_id', 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('instructor/instructors_view', $this->data);
  }


  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->instructorModel->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create instructor';
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
  //This method consists of single Students , obtains id the data from the GET method, return Json
  public function singleInstructor($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($this->data[$this->model] = $this->instructorModel->where($this->primaryKey, $id)->first()) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error instructor';
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
      $dataModel['updated_at']  = $today;
      //Update data model 
      if ($this->instructorModel->update($id, $dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error update instructor';
        $this->data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $this->data['data'] = '';
      }
    } else {
      $this->data['message'] = 'Error Ajax';
      $this->data['response'] = ResponseInterface::HTTP_CONFLICT;
      $this->data['data'] = '';
    }
    //Change array to Json
    echo json_encode( $this->data);
  }
  //This method consists of delete Instructor, obtains id the data from the GET method, return Json
  public function delete($id = null)
  {
    try {
      //Delete data model 
      if ($this->instructorModel->where($this->primaryKey, $id)->delete($id)) {
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
      'Instructor_id' => $this->request->getVar('Instructor_id'),
      'Instructor_document' => $this->request->getVar('Instructor_document'),
      'Instructor_first_name' => $this->request->getVar('Instructor_first_name'),
      'Instructor_last_name' => $this->request->getVar('Instructor_last_name'),
      'Instructor_phone' => $this->request->getVar('Instructor_phone'),
      'Instructor_email' => $this->request->getVar('Instructor_email'),
      'Instructor_address' => $this->request->getVar('Instructor_address'),
      'Instructor_birth_date' => $this->request->getVar('Instructor_birth_date'),
      'Instructor_gender' => $this->request->getVar('Instructor_gender'),
      'User_fk' => $this->request->getVar('User_fk'),
      'Document_type_fk' => $this->request->getVar('Document_type_fk'),
      'Specialty_fk' => $this->request->getVar('Specialty_fk'),
      'User_status_fk' => $this->request->getVar('User_status_fk'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }
}
