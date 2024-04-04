<?php

/* This PHP code snippet is setting up a basic routing system for a web application. Here's a breakdown
of what each part of the code is doing: */
require_once(__DIR__ . '/../app/Config/Constant.php');
require_once(__DIR__ . '/../app/Config/Autoload.php');

use App\Config\Config;
use App\Config\Router;

/* This part of the code is initializing a new `Config` object, creating a new `Router` object by
passing the routes obtained from the `Config` object, and then using the `Router` object to get the
route based on the current request URI from `['REQUEST_URI']`. This process helps in setting
up the routing system for the web application by retrieving the appropriate route based on the
requested URI. */
$config = new Config();
$router = new Router($config->getRoutes()['routes']);
$route = $router->getRoute($_SERVER['REQUEST_URI']);

/* This part of the code is responsible for handling the routing logic. Here's a breakdown of what it
does: */
if ($route) {
  if (class_exists($route['controller'])) {
    $controller = new $route['controller'];
    if (method_exists($controller, $route['method'])) {
      $controller->{$route['method']}();
    }
  }
} else {
  echo "404 Not Found";
}
