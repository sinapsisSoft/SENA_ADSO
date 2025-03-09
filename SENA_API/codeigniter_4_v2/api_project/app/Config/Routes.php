<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("apiV1",function($routes){
  $routes->post("addUserApi","RegisterUserApi::index");
  $routes->post("loginApi","LoginApi::index");
  $routes->get("usersApi","UserApi::index");
});
