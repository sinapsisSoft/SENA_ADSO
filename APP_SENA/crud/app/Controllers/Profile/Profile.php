<?php
/**
 * Author:DIEGO CASALLAS
 * Date:22/05/2024
 * Descriptions:This is controller class for managing profile
 * **/
//Is file namespace   
namespace App\Controllers\Profile;
//These are the class that will be used in this controller
use App\Models\Profile\ProfileModel;
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
      if ($this->data[$this->model] = $this->profileModel->where('User_id_fk', $id)->first()) {
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
    return view('profile/profile_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert Codeigniter
      if ($this->profileModel->insert($dataModel)) {
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

  //This method consists of update status, obtains id the data from the POST method, return Json
  public function update()
  {
    //Validate is ajax
    if ($this->request->isAJAX()) {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $dataModel = $this->getDataModel();
      $dataModel['updated_at']= $today;
      //Update data model 
      if ($this->profileModel->update($id, $dataModel)) {
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
      if ($this->profileModel->where($this->primaryKey, $id)->delete($id)) {
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
      'Profile_id' => $this->request->getVar('Profile_id'),
      'Profile_email' => $this->request->getVar('Profile_email'),
      'Profile_name' => $this->request->getVar('Profile_name'),
      'Profile_photo' => $this->request->getVar('Profile_photo'),
      'User_id_fk' => $this->request->getVar('User_id_fk'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }
}
