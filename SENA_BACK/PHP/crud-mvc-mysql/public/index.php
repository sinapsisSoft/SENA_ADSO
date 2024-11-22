<?php
require_once __DIR__ . '/../app/Config/Routing.php';
require_once __DIR__ . '/../app/Config/Constants.php';
use App\Config\Routes;


try{
  
  new Routes();
}
catch(Exception $e){
  echo("Error:". $e);
}

  
  
?>