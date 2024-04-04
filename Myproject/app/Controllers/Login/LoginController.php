<?php
namespace App\Controllers\Login;

use App\System\interface\IController;
use App\Config\View;

/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IController
 * 
 */


class LoginController implements IController
{

  private $model;
  private $primaryKey;
  private $data;
  private $view;

  public function __construct()
  {
    //$this->model=new UserModel();
    $this->primaryKey="User_id";
    $this->data=[];
    $this->view=new View();
   
  }
  public function create()
  {
  }
  public function update()
  {
  }
  public function edit()
  {
  }
  public function delete()
  {
    echo("This delete");
  }
  /**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This method displays the data model of all registerd users
 * 
 */
  public function show()
  {
    try{
      $this->data['title']="User";
      //$this->data['data']=$this->model->spShow();
      //$this->data['css']=$this->view->reder('assets/css/css');
     
      $data = ['nombre' => 'Juan Pérez', 'edad' => 30];
      $this->view->render('login/login', $data);
     
 
    }catch(Exception $e){
      $this->data['error']=$e->getMessage();
    }

    return  $this->data;
  }
    /**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This method displays the data model of all registerd user for id 
 * 
 */
  public function showId()
  {
    try{
      $id=2;
      
      $this->data['data']=$this->model->spShowId($id);
      //$this->data['css']=$this->view->reder('assets/css/css');
      
 
    }catch(Exception $e){
      $this->data['error']=$e->getMessage();
    }

    return  $this->data;
  }
  public function getDataModel(int $id)
  {
  }
 
}
