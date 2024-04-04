<?php
namespace App\Config;
class Config{
    
  public function getRoutes():array{
    return [
      'routes' => require_once('../app/Config/routes.php')
    ];
  }

}

