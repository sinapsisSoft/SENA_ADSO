<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/04/2025
 * Descriptions:This is controller class for managing Specialty state
 * **/

//Is file namespace   
namespace App\Controllers\Specialty;

//These are the class that will be used in this controller

use App\Models\Specialty\SpecialtyModel;
use App\Models\Profile\ProfileModel;
use App\Models\Role\RoleModulesModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the Specialties state class
class Specialty extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $roleModuleModel;
  private $profileModel;
  private $specialtyModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Specialty_id";
    $this->profileModel = new ProfileModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->specialtyModel=new SpecialtyModel();
    $this->data = [];
    $this->model = "specialty";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "SPECIALTY";
    $this->data[$this->model] = $this->specialtyModel->orderBy($this->primaryKey, 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('specialty/specialty_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->specialtyModel->insert($dataModel)) {
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
  public function singleSpecialty($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select user status model 
      if ($this->data[$this->model] = $this->specialtyModel->where($this->primaryKey, $id)->first()) {
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
      $dataModel['updated_at']=$today;
      //Update data model 
      if ($this->specialtyModel->update($id, $dataModel)) {
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
      if ($this->specialtyModel->where($this->primaryKey, $id)->delete($id)) {
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
      'Specialty_id' => $this->request->getVar('Specialty_id'),
      'Specialty_code' => $this->request->getVar('Specialty_code'),
      'Specialty_name' => $this->request->getVar('Specialty_name'),
      'Specialty_name' => $this->request->getVar('Specialty_name'),
      'updated_at' => $this->request->getVar('updated_at')
    ];

    return $data;
  }
}
