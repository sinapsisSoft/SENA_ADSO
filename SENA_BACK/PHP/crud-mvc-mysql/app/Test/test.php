<?php
namespace App\Test;

 include_once('../../app/Config/ConnectDB.php');

 use App\Config\ConnectDB;

$connDB= new ConnectDB();
$pdo=$connDB->connect();
$name="Inactive";
// $result=$pdo->query("SELECT * FROM `user` ");
//$result=$stmt->execute([$name]);

// $sql = "INSERT INTO userstatus (userStatus_name) VALUES (?)";
//$result=$stmt->execute([$name]);
 $sql = "INSERT INTO user (user_user,user_password,userStatus_fk,role_fk ) VALUES (?,?,?,?)";

$user="user@email.com";
$password=password_hash("12345678", PASSWORD_DEFAULT);
$status=1;
$role=1;
$stmt= $pdo->prepare($sql);
$result=$stmt->execute([$user,$password,$status,$role]);

var_dump($result);
?>