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
  $userId=$_POST['User_id'];
  $userStatusId=$_POST['User_status_id'];
  $roleId=$_POST['Role_id'];

   $query = "UPDATE `user` SET User_status_id=". $userStatusId.",Role_id=". $roleId." WHERE User_id=". $userId."; ";


$result = $mysqli->query($query);
header('Location: http://localhost/SENA/SENA_ADSO/Myproject/app/Views/user/user.php');
  
}
