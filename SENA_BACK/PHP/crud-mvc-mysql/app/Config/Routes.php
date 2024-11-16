<?php
/**
 * Author:DIEGO CASALLAS
 * Date:08/11/2024
 * Descriptions: This is the connection class for MySQL
 */
namespace APP\Config;

use App\Controllers\UserController;
use App\Controllers\RoleController;
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
    } catch (Exception $e) {
      echo ("Error:" . $e);
    }
  }
  /**
   * The function `getRoutes` retrieves the appropriate route based on the controller and method
   * provided.
   * 
   * @param controller The `controller` parameter in the `getRoutes` function refers to the type of
   * controller for which you want to retrieve routes. It is used to determine whether to fetch routes
   * for the `UserController` or the `ErrorController`.
   * @param method The `method` parameter in the `getRoutes` function represents the specific action or
   * operation that needs to be performed on a particular route. It could be actions like create, show,
   * showId, update, or delete in the case of user routes, and index in the case of error routes.
   * 
   * @return If the `` exists in the routes array and the `` matches a method in the
   * corresponding routes, then the specific route array with the method details will be returned. If
   * the `` does not exist in the routes array, then the first route from the errorRoutes
   * array will be returned. If the method does not match any method in the specified controller's
   * routes, then the first
   */
  private function getRoutes($controller, $method)
  {
    $userRoutes = [
      ["method" => "create", "REQUEST" => "POST", "controller" => "UserController"],
      ["method" => "show", "REQUEST" => "GET", "controller" => "UserController"],
      ["method" => "showId", "REQUEST" => "GET", "controller" => "UserController"],
      ["method" => "update", "REQUEST" => "PUT", "controller" => "UserController"],
      ["method" => "delete", "REQUEST" => 'DELETE', "controller" => "UserController"],
      ["method" => "index", "REQUEST" => "GET", "controller" => "UserController"],
    ];
    $roleRoutes = [
      ["method" => "create", "REQUEST" => "POST", "controller" => "RoleController"],
      ["method" => "show", "REQUEST" => "GET", "controller" => "RoleController"],
      ["method" => "showId", "REQUEST" => "GET", "controller" => "RoleController"],
      ["method" => "update", "REQUEST" => "PUT", "controller" => "RoleController"],
      ["method" => "delete", "REQUEST" => 'DELETE', "controller" => "RoleController"],
      ["method" => "index", "REQUEST" => "GET", "controller" => "RoleController"],
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
