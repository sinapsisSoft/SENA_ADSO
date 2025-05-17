<?php
/**
 * Author:DIEGO CASALLAS
 * Date:01/05/2025
 * Descriptions:This is controller class for managing student status.
 * **/
//Is file namespace   
namespace App\Controllers\Student;
//These are the class that will be used in this controller
use App\Models\Student\StudentStatusModel;
use App\Models\Role\RoleModulesModel;
use App\Models\Profile\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the user class
class StudentStatus extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $studentStatusModel;
  private $profileModel;
  private $roleModuleModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  { 
    $this->primaryKey = "Student_status_id";
    $this->studentStatusModel = new StudentStatusModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->profileModel = new ProfileModel();
    $this->data = [];
    $this->model = "studentStatus";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "STUDENTS STATUS";
    $this->data[$this->model] = $this->studentStatusModel->orderBy($this->primaryKey, 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('studentStatus/studentStatus_view', $this->data);
  }

  
  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->studentStatusModel->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create student status';
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
  public function singleStudentStatus($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
 
      if ($data[$this->model] = $this->studentStatusModel->where($this->primaryKey, $id)->first()) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error students status';
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
      if ($this->studentStatusModel->update($id, $dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error update student status';
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
      if ($this->studentStatusModel->where($this->primaryKey, $id)->delete($id)) {
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
      'Student_status_id' => $this->request->getVar('Student_status_id'),
      'Student_status_name' => $this->request->getVar('Student_status_name'),
      'Student_status_description' => $this->request->getVar('Student_status_description'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }
}
