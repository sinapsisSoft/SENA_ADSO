<?php
  namespace App\Controllers;

  use App\Controllers\BaseController;
  use CodeIgniter\API\ResponseTrait;
  use App\Models\UserApiModel;
  
  class UserApi extends BaseController
  {
    use ResponseTrait;

    public function index(){
      $userApiModel=new UserApiModel();
      return $this->respond(['User_Api'=>$userApiModel->findAll()],200);
    }
  }
?>