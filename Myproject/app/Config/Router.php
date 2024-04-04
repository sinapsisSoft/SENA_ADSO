<?php
namespace App\Config;
class Router{
  private $arrayRoutes;
  private $folder;
    public function __construct($routes)
    {
      $this->folder = "public";
      $this->arrayRoutes=$routes;
    }

    public function getRoute($uri){

      $arrayGetData = [];
      if ($longUrl = strpos($uri, $this->folder)) {
      $newLongUrl = $longUrl + (strlen($this->folder));
      $arrayGetData = explode("/", substr($uri,  $newLongUrl));
      $routes['controller']= $this->arrayRoutes[substr($uri,$newLongUrl)]['controller'];
      $routes['method']= $this->arrayRoutes[substr($uri,  $newLongUrl)]['method'];
      $routes['parametres']=(isset($arrayGetData[2])) ? ucfirst($arrayGetData[2]) : "";
    
    } else {
      $routes=false;
    }
      return $routes;
    }
}