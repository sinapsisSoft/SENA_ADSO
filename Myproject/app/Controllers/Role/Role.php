<?php

/**
 * Author:DIEGO CASALLAS
 * Date:15/02/2024
 * Update Date:
 * Descriptions: this is class controller role
 * 
 */
include("../../Models/Role/RoleModel.php");

class Role{
  private $result;
  private $objModel;
  public function __construct()
  {
    $this->result=null;
    $this->objModel=new RoleModel();
  }

  public function GetRoles(){
    try{
      $this->result=$this->objModel->GetModelRoles();
    }
    catch(Exception $e){
      echo("Error: ".$e->getMessage());
    }
    return $this->result;

  }



}

?>