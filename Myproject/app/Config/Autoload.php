
<?php

function my_Autoload($className)
{
  $txtController = "Controller";
  $txtModel = "Model";
  $folderController = str_replace($txtController, "", $className);
  $folderModel = str_replace($txtController,"",str_replace($txtModel, "", $className));
  $folder="";
  $paths = [
    '..\app\Controllers\\' . $folderController.'\\' . $className . '.php',
    '..\app\Models\\' .$folderModel . '\\' . $className . '.php',
    '..\app\System\core' . '\\' . $className . '.php',
    '..\app\System\interface'. '\\' . $className . '.php',
  ];

// If the file exists, require it
  foreach ($paths as $path) {
    //echo("<br> ".$path."<br> ");
    if (file_exists($path)) {
      echo("<br> ".$path);
      require_once $path;
    }
  }
}
spl_autoload_register('my_Autoload');

?>
