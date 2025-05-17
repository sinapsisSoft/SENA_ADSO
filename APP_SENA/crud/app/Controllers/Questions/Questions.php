<?php

/**
 * Author:DIEGO CASALLAS
 * Date:09/05/2025
 * Descriptions:This is controller class for managing Programs Groups
 * **/
//Is file namespace   
namespace App\Controllers\Questions;
//These are the class that will be used in this controller
use App\Models\Questions\QuestionsModel;
use App\Models\Questionnaires\QuestionnairesModel;
use App\Models\Instructor\InstructorModel;
use App\Models\Role\RoleModulesModel;
use App\Models\Profile\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

//This is the user class
class Questions extends Controller
{
  //Variable declarations. 
  private $primaryKey;
  private $questionsModel;
  private $ProgramsGroupInstructorModel;
  private $questionnairesModel;
  private $instructorModel;
  private $profileModel;
  private $roleModuleModel;
  private $data;
  private $model;
  //This method is the constructor
  public function __construct()
  {
    $this->primaryKey = "Question_id";
    $this->questionsModel = new QuestionsModel();
    $this->questionnairesModel = new QuestionnairesModel();
    $this->instructorModel = new InstructorModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->profileModel = new ProfileModel();
    $this->data = [];
    $this->model = "questions";
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "QUESTIONS";
    $this->data[$this->model] = $this->questionsModel->sp_questions();
    $this->data['questionnaires'] = $this->questionnairesModel->orderBy('Questionnaire_id ', 'ASC')->findAll();
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('questions/questions_view', $this->data);
  }

  //This method consists of creating, obtains the data from the POST method, return Json
  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel();
      //Query Insert 
      if ($this->questionsModel->insert($dataModel)) {
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
  public function singleQuestions($id = null)
  {    //Validate is ajax
    if ($this->request->isAJAX()) {
      //Select student  model 
      if ($this->data[$this->model] = $this->questionsModel->sp_question_id($id)) {
        $this->data['message'] = 'success';
        $this->data['response'] = ResponseInterface::HTTP_OK;
        $this->data['csrf'] = csrf_hash();
      } else {
        $this->data['message'] = 'Error Questions';
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
      if ($this->questionsModel->update($id, $dataModel)) {
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
  public function delete($id = null)
  {
    
  }


  //This method consists of create is model the data in the array associative, return Array
  public function getDataModel()
  {

    $data = [
      'Question_id' => $this->request->getVar('Question_id'),
      'Questionnaire_fk' => $this->request->getVar('Questionnaire_fk'),
      'Question_text' => $this->request->getVar('Question_text'),
      'Question_answer_type' => $this->request->getVar('Question_answer_type'),
      'Question_weight' => $this->request->getVar('Question_weight'),
      'Question_display_order' => $this->request->getVar('Question_display_order'),
      'Qis_active' => $this->request->getVar('Qis_active'),
      'updated_at' => $this->request->getVar('updated_at'),
    ];
    return $data;
  }

}
