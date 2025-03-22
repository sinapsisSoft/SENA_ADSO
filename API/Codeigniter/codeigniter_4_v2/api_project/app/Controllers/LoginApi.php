<?php

  namespace App\Controllers;

  use App\Controllers\BaseController;
  use CodeIgniter\API\ResponseTrait;
  use App\Models\UserApiModel;
  use Firebase\JWT\JWT;


  class LoginApi extends BaseController{
    use ResponseTrait;

    public function index(){
      $userApiModel=new UserApiModel();
      $email=$this->request->getVar('email');
      $password=$this->request->getVar('password');
      $userApi=$userApiModel->where('User_email',$email)->first();

      if(is_null($userApi)){
        return $this->respond(['error'=>'Invalid Username'],401);
      }
      $pwd_verify=password_verify($password,$userApi['User_password']);
      if(!$pwd_verify){
        return $this->respond(['error'=>'Invalid Username or Password'],401);
      }
      $key=getenv('JWT_SECRET');
      $iat=time();
      $exp=$iat+3600;
      $payload=array(
          "iss"=>"Issuer of the JWT",
          "aud"=>"Audience that the JWT",
          "sub"=>"subject of the JWT",
          "iat"=>$iat, //Time the JWT issued at
          "exp"=>$exp, //Expiration time of token
          "email"=>$userApi['User_email']
      );
      $token=JWT::encode($payload,$key,'HS256');
      $response=[
          "message"=> "login Successful",
          "token"=>$token
      ];

      return $this->respond($response,200);
    }
  }

?>