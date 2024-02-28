<?php

/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This is user class have implemented the methods the interface IController
 * 
 */
require_once('Constant.php');

class View
{
  private $data = array();
  private $render;

  public function __construct()
  {
    $this->render = FALSE;
  }
  function reder(string $name, array $data = [])
  {
    try {
      $file = SERVER.ROOT_VIEW. strtolower($name) . '.php';

      echo($file);
      if (file_exists("../../Views/user/user.php")) {
        $this->render = $file;
        //include($file);
      } else {
        echo ('Template ' . $name . ' not found!');
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  public function assign($variable, $value)
  {
    $this->data[$variable] = $value;
  }

  public function __destruct()
  {
    //extract($this->data);
    
    require_once('../Views/user/user.php');
  }
}
