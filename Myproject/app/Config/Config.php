<?php

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

//$query = "SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
//INNER JOIN role ROL ON US.Role_id=ROL.Role_id
//INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id;";

$query = "SELECT * FROM USER";

$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}
$result->free_result();
$mysqli->close();

echo json_encode($data);
