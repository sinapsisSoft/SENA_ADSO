<?php

/**
 * Author:DIEGO CASALLAS
 * Date:08/11/2024
 * Descriptions: This is the connection class for MySQL
 */
namespace App\Config;
/* The Routing class in PHP is responsible for autoloading classes by converting namespaces to file
paths and including the corresponding PHP files. */

class Routing
{
  /**
   * The function autoload PHP classes by converting the class name to a file path and including the
   * file if it exists.
   * 
   * @param className The `` parameter in the `autoload` function represents the name of the
   * class that needs to be loaded. It is modified by removing the "App\" namespace prefix and replacing
   * backslashes with the directory separator. This modified class name is used to construct the file
   * path where the class file is expected
   */
  public static function autoload($className)
  {
    $className = str_replace("App\\", "", $className);
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $file = str_replace("Config", "", __DIR__) . "/" . $className . ".php";
    if (file_exists($file)) {
      require_once $file;
      //echo(  $className );
      // echo("</br>");
    } else {
      echo "The class {$className} could not be loaded from {$file}";
    }
  }
}

spl_autoload_register(['App\Config\Routing', 'autoload']);
