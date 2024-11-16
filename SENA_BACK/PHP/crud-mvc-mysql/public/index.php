<?php
require_once __DIR__ . '/../app/Config/Routing.php';
use App\Config\Routes;

try{
  new Routes();
}
catch(Exception $e){
  echo("Error:". $e);
}

  
  
?>