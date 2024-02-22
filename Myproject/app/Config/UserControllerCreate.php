<?php
/**
 * Author:DIEGO CASALLAS
 * Date:13/02/2024
 * Update Date:
 * Descriptions:
 * 
 */
include_once('../Config/Config.php');

if(!empty($_POST) && isset($_POST)){
  $userUser=$_POST['User_user'];
  $userPassword=password_hash($_POST['User_password'],PASSWORD_DEFAULT);
  $userStatusId=$_POST['User_status_id'];
  $roleId=$_POST['Role_id'];

   $query = "INSERT INTO `user`(`User_id`, `User_user`, `User_password`, `User_status_id`, `Role_id`)VALUES
   (null,'".$userUser."','".$userPassword."',".$userStatusId.",".$roleId.")";


  $result = $mysqli->query($query);
  header('Location: http://localhost/SENA/SENA_ADSO/Myproject/app/Views/user/user.php');
  
}
