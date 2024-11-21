<?php

namespace App\Controllers;

use App\Config\View;
use Exception;

class ErrorController
{
  private $data;
  public function __construct()
  {
    $this->data = [];
  }
  public function index()
  {
    try {
      $view = new View('errors/error_404');
      $view->set('title', '404 Error Page');
      $view->render();
    } catch (Exception $e) {
      $this->data['data'] = [];
      $this->data['status'] = 404;
      $this->data['message'] = "Error: " . $e->getMessage();
    }
  }
}
