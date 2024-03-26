<?php

require_once("../app/Config/Constant.php");

function my_Autoload($class) {
var_dump(PATH_MODELS."$class/$class.php");
echo( "</br>");
  if(is_file(PATH_CONTROLLERS."$class/$class.php"))
  $getPath=PATH_CONTROLLERS."$class/$class.php";
  if(is_file(PATH_MODELS."user/$class.php"))
  $getPath=PATH_MODELS."user/$class.php";
  if(is_file(PATH_SYSTEM_CORE."$class.php"))
  $getPath=PATH_SYSTEM_CORE."$class.php";
 
 

  include($getPath);
}

spl_autoload_register('my_Autoload');

$uri = URI;
$folder = "public/";
if ($longUrl = strpos($uri, $folder)) {

  $newLongUrl = $longUrl + (strlen($folder));
  $arrayGetData = explode("/", substr($uri,  $newLongUrl));

  $getController = ucfirst($arrayGetData[0]);
  $getMethod = $arrayGetData[1];
  $getAttributes = $arrayGetData[2];

  $controller=new $getController;
  $controller->$getMethod();

}else{
  echo("Error: 404"); 
}
?>
