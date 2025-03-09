<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserApiModel;

class RegisterUserApi extends BaseController{

  use ResponseTrait;
  public function index()
  {
      $rules=[

        'email'=>['rules'=>'required|min_length[4]|max_length[255]|valid_email|is_unique[user_api.User_email]'],
        'password'=>['rules'=>'required|min_length[4]|max_length[255]'],
        'confirm_password'=>['label'=>'confirm_password','rules'=>'matches[password]']
      ];

      if($this->validate($rules)){
        $model=new UserApiModel();
        $data=[
          'User_email'=>$this->request->getVar('email'),
          'User_password'=>password_hash($this->request->getVar('password'),PASSWORD_DEFAULT)
        ]; 
        $model->save($data);
        return $this->respond(['message'=>'Registered Successful'],200); 
      }else{
        $response=[
          'error'=>$this->validator->getErrors(),
          'message'=>'Invalid Inputs'
        ];

        return $this->fail($response,409);
      }
  }

}

?>