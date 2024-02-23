<?php

/**
 * Author:DIEGO CASALLAS
 * Date:22/02/2024
 * Update Date:
 * Descriptions:
 * 
 */
include_once('../Config/Config.php');
 if (!empty($_POST) && isset($_POST)) {

  $userId = $_POST['User_id'];
  $userPassword = password_hash($_POST['User_password'], PASSWORD_DEFAULT);

  $query = "CALL changePassword(".  $userId .",'" . $userPassword . "')";
  $result = $mysqli->query($query);
  if( $result ){
    header('Location: http://localhost/SENA/SENA_ADSO/Myproject/app/Views/login/login.php');
  }






 }
