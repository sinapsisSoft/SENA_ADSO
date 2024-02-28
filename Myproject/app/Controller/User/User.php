<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IController
 * 
 */
require_once('../../Interface/IController.php');
require_once('../../Models/User/UserModel.php');
require_once('../../Config/View.php');

class User implements IController
{

  private $model;
  private $primaryKey;
  private $data;
  private $view;

  public function __construct()
  {
    $this->model=new UserModel();
    $this->primaryKey="User_id";
    $this->data=[];
    //$this->view=new View();
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
      $this->data['data']=$this->model->spShow();
      //$this->data['css']=$this->view->reder('assets/css/css');
      
 
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
$obj=new User();
var_dump($obj->showId());
