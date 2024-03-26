<?php
  class User{

    public function show(){
      $objModel=new UserModel();
      $objModel->spShow();
      echo("Controllers/User/User->show())");
    }
    public function showId(){

      echo("Controllers/User/User->showId())");
    }
  }
?>