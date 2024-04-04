<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IController
 * 
 */

namespace App\Controllers\User;

use App\System\interface\IController;
use App\Models\User\UserModel;
use App\Config\View;

class UserController implements IController
{

  private $model;
  private $primaryKey;
  private $data;
  private $view;

  public function __construct()
  {
    $this->model = new UserModel();
    $this->primaryKey = "User_id";
    $this->data = [];
    $this->view = new View();
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
    echo ("This delete");
  }

  public function show()
  {
    try {
      $this->data['title'] = "USER";
      $this->data['data'] = $this->model->spShow();
      $this->view->render('user/show', $this->data);
    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }
    return $this->data;
  }

  public function showId()
  {
    try {
      $id = 2;

      $this->data['data'] = $this->model->spShowId($id);
      //$this->data['css']=$this->view->reder('assets/css/css');
      


    } catch (\Exception $e) {
      $this->data['error'] = $e->getMessage();
    }

    return  $this->data;
  }
  public function getDataModel(int $id)
  {
  }
}
