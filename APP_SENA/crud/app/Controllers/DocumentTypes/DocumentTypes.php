<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/04/2025
 * Descriptions:This is controller class for managing Document Types.
 * This class is responsible for handling the CRUD operations for Document Types.
 * **/

//Is file namespace   
namespace App\Controllers\DocumentTypes;

//These are the class that will be used in this controller
use App\Models\DocumentTypes\DocumentTypesModel;
use App\Models\Profile\ProfileModel;
use App\Models\Role\RoleModulesModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the Document Types class
class DocumentTypes extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $DocumentTypes;
  private $roleModuleModel;
  private $profileModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Document_type_id";
    $this->profileModel = new ProfileModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->DocumentTypes = new DocumentTypesModel();
    $this->data = [];
    $this->model = "documentTypes";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "DOCUMENT TYPES";
    $this->data[$this->model] = $this->DocumentTypes->orderBy($this->primaryKey, 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('documentTypes/documentTypes_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert Codeigniter
      if ($this->DocumentTypes->insert($dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error create document type';
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
   //This method consists of single User permission , obtains id the data from the GET method, return Json

  //This method consists of single Document types , obtains id the data from the GET method, return Json
  public function singleDocumentTypes($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select Document Types model 
      if ($this->data[$this->model] = $this->DocumentTypes->where($this->primaryKey, $id)->first()) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error query Document type';
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
      $dataModel = [
        'Document_type_code' => $this->request->getVar('Document_type_code'),
        'Document_type_name' => $this->request->getVar('Document_type_name'),
        'Document_type_description' => $this->request->getVar('Document_type_description'),
        'updated_at' => $today
      ];
      //Update data model 
      if ($this->DocumentTypes->update($id, $dataModel)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['data'] = $dataModel;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error update Document type';
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
      if ($this->DocumentTypes->where($this->primaryKey, $id)->delete($id)) {
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
      'Document_type_id' => $this->request->getVar('Document_type_id'),
      'Document_type_code' => $this->request->getVar('Document_type_code'),
      'Document_type_name' => $this->request->getVar('Document_type_name'),
      'Document_type_description' => $this->request->getVar('Document_type_description'),
      'updated_at' => $this->request->getVar('updated_at')
    ];
    return $data;
  }
}
