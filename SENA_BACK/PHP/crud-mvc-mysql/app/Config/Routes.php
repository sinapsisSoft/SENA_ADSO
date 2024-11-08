<?php

namespace APP\Config;

use App\Controllers\UserController;
use App\Controllers\LoginController;
use App\Controllers\ErrorController;

use Exception;

class Routes
{

  private $url;
  private $controller;
  private $attributes;
  private $method;

  public function __construct()
  { 
    $this->handleRequest();
  }
  private function handleRequest()
  {
    try {
      $this->url = $_SERVER['REQUEST_URI'];
      $reference = "public/";
      $method = "index";
     
      $attributes = "";
      $replace = str_replace($reference, "", substr($this->url, strpos($this->url, $reference)));
      if ($replace != "") {
        $newUrl = explode("/", $replace);
        $this->controller = $newUrl[0];
        switch ($this->controller) {
          case 'user':
            if (!empty($newUrl[1])) {
              $method = $newUrl[1];
            }
            if (!empty($newUrl[2])) {
              $this->attributes =  $newUrl[2];
            } else {
              $this->attributes = $attributes;
            }
            $controller = new UserController();
            if(method_exists( $controller ,$method)){
              $controller->$method($this->attributes);
            }

            break;
            case 'login':
              if (!empty($newUrl[1])) {
                $method = $newUrl[1];
              }
              if (!empty($newUrl[2])) {
                $this->attributes =  $newUrl[2];
              } else {
                $this->attributes = $attributes;
              }
              $controller = new LoginController();
              if(method_exists( $controller ,$method)){
                $controller->$method($this->attributes);
              }
              
              break;
          default:
            $controller = new ErrorController();
            $controller->index();
            break;
        }
        
      }
    } catch (Exception $e) {
      echo("Error:".$e);
    }
  }
}
