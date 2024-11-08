<?php

namespace APP\Config;

class Routing
{
  public static function autoload($className)
  {
    $className = str_replace("App\\", "", $className);
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
     $file =str_replace("Config","",__DIR__) . "/".$className.".php";
    if (file_exists($file)) {
     require_once $file;
     //echo(  $className );
     //echo("<br>");
    } else {
      echo "The class {$className} could not be loaded from {$file}";
    }
  }
}
spl_autoload_register(['App\Config\Routing', 'autoload']);
