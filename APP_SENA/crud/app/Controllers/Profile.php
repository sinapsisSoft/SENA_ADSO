<?php
/**
 * Author:DIEGO CASALLAS
 * Date:22/05/2024
 * Descriptions:This is controller class for managing profile
 * **/
//Is file namespace   
namespace App\Controllers;
//These are the class that will be used in this controller
use App\Models\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the roles class
class Profile extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $profileModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Profile_id";
    $this->profileModel = new ProfileModel();
    $this->data = [];
    $this->model = "profiles";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index($id=null)
  {
    $this->data['title'] = "PROFILE";
    if ($this->request->isAJAX()) {
      //Select user status model 
      if ($data[$this->model] = $this->profileModel->where('User_id_fk', $id)->first()) {
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
    return view('profile/profile_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert Codeigniter
      if ($this->profileModel->insert($dataModel)) {
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

  //This method consists of update status, obtains id the data from the POST method, return Json
  public function update()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = [
        'Profile_email' => $this->request->getVar('Profile_email'),
        'Profile_name' => $this->request->getVar('Profile_name'),
        'Profile_photo' => $this->request->getVar('Profile_photo'),
        'User_id_fk' => $this->request->getVar('User_id_fk'),
        'update_at' => $today
      ];
      //Update data model 
      if ($this->profileModel->update($id, $dataModel)) {
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
      if ($this->profileModel->where($this->primaryKey, $id)->delete($id)) {
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
      'Profile_id' => $this->request->getVar('Profile_id'),
      'Profile_email' => $this->request->getVar('Profile_email'),
      'Profile_name' => $this->request->getVar('Profile_name'),
      'Profile_photo' => $this->request->getVar('Profile_photo'),
      'User_id_fk' => $this->request->getVar('User_id_fk'),
      'update_at' => $this->request->getVar('update_at'),
    ];
    return $data;
  }
}
