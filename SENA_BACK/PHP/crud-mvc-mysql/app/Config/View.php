<?php
  namespace App\Config;

  use Exception;
  class View{
      protected $viewPath;
      protected $viewName;
      protected $data=[];
  /**
   * The constructor function sets the view path and name by manipulating the input parameters.
   * 
   * @param viewName The `viewName` parameter in the constructor function is used to specify the name
   * or path of the view that will be loaded by the class. It seems like the `viewName` parameter is
   * expected to be a string representing the view name or path.
   */
      public function __construct($viewName)
      { 
          $this->viewPath=str_replace("Config","",__DIR__.$this->viewPath);
          $this->viewPath=$this->viewPath.'\\Views\\';
          $this->viewPath=str_replace("\\",DIRECTORY_SEPARATOR,$this->viewPath);
          $this->viewName=str_replace("/","\\",$viewName);
      }
      public function set($key,$value){
        $this->data[$key]=$value;
        return $this;
      }
/**
 * The render function in PHP checks if a view file exists, throws an exception if not, extracts data,
 * and includes the file.
 */
      public function render(){
        $fullPath=$this->viewPath.'\\'.$this->viewName.'.php';
        if(!file_exists($fullPath)){
          throw new Exception("View file not found : ".$fullPath);
        }
        extract($this->data);
        include($fullPath);

      }
  }
?>