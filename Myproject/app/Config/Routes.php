<?php
namespace App\Config;
class Routes
{

  private $uri;
  private $folder;
  private $controller; 
  private $method;
  private $parametres; 

  public function __construct()
  {
    $this->uri = URI;
    $this->folder = "public/";
    $this->getDataRoutes();
  }

  private function getDataRoutes()
  {
    $arrayGetData = [];
    if ($longUrl = strpos($this->uri, $this->folder)) {
      $newLongUrl = $longUrl + (strlen($this->folder));
      $arrayGetData = explode("/", substr($this->uri,  $newLongUrl));
      $this->controller = (ucfirst(isset($arrayGetData[0])) ? ucfirst($arrayGetData[0]) : "");
      $this->method = (isset($arrayGetData[1])) ? ucfirst($arrayGetData[1]) : "";
      $this->parametres = (isset($arrayGetData[2])) ? ucfirst($arrayGetData[2]) : "";
    } else {
      echo ("Error: 404");
    }
    
  }
  public function getController():string{
      return $this->controller;
  }
  public function getMethod():string{
    return $this->method;
}
public function getParametres():string{
  return $this->parametres;
}
}
