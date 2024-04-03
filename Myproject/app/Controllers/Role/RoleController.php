<?php

/**
 * Author:DIEGO CASALLAS
 * Date:15/02/2024
 * Update Date:
 * Descriptions: this is class controller role
 * 
 */


use App\Models\Role\RoleModel;

class RoleController{
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