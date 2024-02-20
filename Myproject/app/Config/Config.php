<?php
/**
 * Author:DIEGO CASALLAS
 * Date:13/02/2024
 * Update Date:
 * Descriptions:
 * 
 */
$host = "localhost";
$user = "root";
$password = "";
$myDB = "apiSENA";
$data = array();
$mysqli = new mysqli($host, $user, $password, $myDB);

if ($mysqli->connect_error) {
  echo ("Faild to connect " . $mysqli->connect_error);
} else {
  //echo("Connect OK");
}


