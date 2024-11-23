<?php

/**
 * Author:DIEGO CASALLAS
 * Date:13/11/2024
 * Descriptions: This is the class for managing allowed routes.
 */

namespace App\Config;

use App\Controllers\ErrorController;


use Exception;

class Routes
{
  private $url;
  private $controller;
  private $attributes;
  private $method;
  private $reference;
  private $routes;

  /**
   * The function initializes variables and processes a request in a PHP class constructor.
   */
  public function __construct()
  {
    $this->url = $_SERVER['REQUEST_URI'];
    $this->reference = "public/";
    $this->method = "index";
    $this->attributes = NULL;
    $this->handleRequest();
    $this->routes = [];
  }

  /**
   * The function `handleRequest` processes a URL to determine the controller, method, and attributes to
   * be used in a PHP application, handling errors appropriately.
   */
  private function handleRequest()
  {
    try {
      $filter = new Filter();
      $filterMethod = "";
      $filterValidate = true;
      $replace = str_replace($this->reference, "", substr($this->url, strpos($this->url, $this->reference)));
      if ($replace != "") {
        $newUrl = explode("/", $replace);
        $this->controller = $newUrl[0];
        if (!empty($newUrl[1])) {
          $this->method = $newUrl[1];
        }
        if (!empty($newUrl[2])) {
          $this->attributes =  $newUrl[2];
        }
        $resultRoute = $this->getRoutes($this->controller, $this->method);
        if (!empty($resultRoute["filter"])) {
          $filterMethod = $resultRoute["filter"];
          $filterValidate = $filter->$filterMethod();
        }
        if ($filterValidate) {
          if ($resultRoute["controller"] != "ErrorController") {
            if ($_SERVER['REQUEST_METHOD'] === $resultRoute['REQUEST']) {
              $class = "App\\Controllers\\" . $resultRoute['controller'];
              $method = $resultRoute['method'];
              $controller = new $class();
              $controller->$method($this->attributes);
            } else {
              $controller = new ErrorController();
              $controller->index();
            }
          } else {
            $controller = new ErrorController();
            $controller->index();
          }
        } else {
          $controller = new ErrorController();
          $controller->index();
        }
      } else {
        $controller = new ErrorController();
        $controller->index();
      }
    } catch (Exception $e) {
      echo ("Error:" . $e);
    }
  }

  /**
   * The function `getRoutes` retrieves routes based on the specified controller and method.
   * 
   * @param controller The `controller` parameter in the `getRoutes` function is used to specify which
   * set of routes to retrieve. It determines which array of routes to look into based on the controller
   * name provided.
   * @param method The `getRoutes` function you provided seems to be a routing mechanism for different
   * controllers and methods. The function takes two parameters: `` and ``. The
   * `` parameter is used to determine which controller's routes to fetch, and the ``
   * parameter is used to find a
   * 
   * @return The function `getRoutes` returns an array containing information about the route based on
   * the provided controller and method. If the specified controller and method match any of the
   * predefined routes, the function returns the corresponding route information. If no matching route
   * is found, it returns the default error route information.
   */
  private function getRoutes($controller, $method)
  {
    $userRoutes = [
      ["method" => "create", "REQUEST" => "POST", "controller" => "UserController"],
      ["method" => "show", "REQUEST" => "GET", "controller" => "UserController"],
      ["method" => "showId", "REQUEST" => "GET", "controller" => "UserController"],
      ["method" => "update", "REQUEST" => "POST", "controller" => "UserController"],
      ["method" => "edit", "REQUEST" => "GET", "controller" => "UserController"],
      ["method" => "delete", "REQUEST" => 'POST', "controller" => "UserController"],
      ["method" => "index", "REQUEST" => "GET", "controller" => "UserController", "filter" => "logIn"],
      ["method" => "viewCreate", "REQUEST" => 'GET', "controller" => "UserController","filter" => "logIn"],
      ["method" => "viewDelete", "REQUEST" => 'GET', "controller" => "UserController","filter" => "logIn"],
    ];
    $loginRoutes = [
      ["method" => "logIn", "REQUEST" => "POST", "controller" => "LoginController"],
      ["method" => "logOut", "REQUEST" => "GET", "controller" => "LoginController"],
      ["method" => "lostPassword", "REQUEST" => "POST", "controller" => "LoginController"],
      ["method" => "index", "REQUEST" => 'GET', "controller" => "LoginController"],
      ["method" => "viewLostPassword", "REQUEST" => 'GET', "controller" => "LoginController"],
      ["method" => "viewPasswordChange", "REQUEST" => 'GET', "controller" => "LoginController"],
    ];
    $homeRoutes = [
      ["method" => "dashboard", "REQUEST" => "GET", "controller" => "HomeController", "filter" => "logIn"],
    ];
    $roleRoutes = [
      ["method" => "create", "REQUEST" => "POST", "controller" => "RoleController"],
      ["method" => "show", "REQUEST" => "GET", "controller" => "RoleController"],
      ["method" => "showId", "REQUEST" => "GET", "controller" => "RoleController"],
      ["method" => "update", "REQUEST" => "POST", "controller" => "RoleController"],
      ["method" => "edit", "REQUEST" => "GET", "controller" => "RoleController"],
      ["method" => "delete", "REQUEST" => 'POST', "controller" => "RoleController"],
      ["method" => "index", "REQUEST" => "GET", "controller" => "RoleController", "filter" => "logIn"],
      ["method" => "viewCreate", "REQUEST" => 'GET', "controller" => "RoleController","filter" => "logIn"],
      ["method" => "viewDelete", "REQUEST" => 'GET', "controller" => "RoleController","filter" => "logIn" ],
    ];
    $userStatusRoutes = [
      ["method" => "create", "REQUEST" => "POST", "controller" => "UserStatusController"],
      ["method" => "show", "REQUEST" => "GET", "controller" => "UserStatusController"],
      ["method" => "showId", "REQUEST" => "GET", "controller" => "UserStatusController"],
      ["method" => "update", "REQUEST" => "PUT", "controller" => "UserStatusController"],
      ["method" => "delete", "REQUEST" => 'DELETE', "controller" => "UserStatusController"],
      ["method" => "index", "REQUEST" => "GET", "controller" => "UserStatusController"],
    ];
    $moduleRoutes = [
      ["method" => "create", "REQUEST" => "POST", "controller" => "ModuleController"],
      ["method" => "show", "REQUEST" => "GET", "controller" => "ModuleController"],
      ["method" => "showId", "REQUEST" => "GET", "controller" => "ModuleController"],
      ["method" => "update", "REQUEST" => "PUT", "controller" => "ModuleController"],
      ["method" => "delete", "REQUEST" => 'DELETE', "controller" => "ModuleController"],
      ["method" => "index", "REQUEST" => "GET", "controller" => "ModuleController"],
    ];
    $roleModuleRoutes = [
      ["method" => "create", "REQUEST" => "POST", "controller" => "RoleModuleController"],
      ["method" => "show", "REQUEST" => "GET", "controller" => "RoleModuleController"],
      ["method" => "showId", "REQUEST" => "GET", "controller" => "RoleModuleController"],
      ["method" => "update", "REQUEST" => "PUT", "controller" => "RoleModuleController"],
      ["method" => "delete", "REQUEST" => 'DELETE', "controller" => "RoleModuleController"],
      ["method" => "index", "REQUEST" => "GET", "controller" => "RoleModuleController"],
    ];
    $errorRoutes = [
      ["method" => "index", "REQUEST" => "GET", "controller" => "ErrorController"]
    ];
    $this->routes["user"] = $userRoutes;
    $this->routes["home"] = $homeRoutes;
    $this->routes["login"] = $loginRoutes;
    $this->routes["role"] = $roleRoutes;
    $this->routes["userStatus"] = $userStatusRoutes;
    $this->routes["module"] = $moduleRoutes;
    $this->routes["roleModule"] = $roleModuleRoutes;
    $this->routes["error"] = $errorRoutes;
    if (empty($this->routes[$controller])) {
      return $this->routes["error"][0];
    }
    $getRoute = $this->routes[$controller];
    for ($i = 0; $i < count($getRoute); $i++) {
      if ($getRoute[$i]["method"] == $method) {
        return $getRoute[$i];
      }
    }
    return $this->routes["error"][0];
  }
}
