<?php
namespace App\Config;
class View{
  private $view;
  private $data;
  public function __construct()
  {
    
  }
  public function render($view, $data = []) {
    extract($data); // Extract the variables from the array
    ob_start(); // Start buffering
    include '../app/Views/' . $view . '.php'; // Load the view
    $content = ob_get_clean(); // Gets the contents of the buffer and clears it
    echo $content; //Display the content of the view
  }
}
?>