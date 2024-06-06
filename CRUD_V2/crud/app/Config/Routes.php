<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



//GROUP ROUTES
$routes->group("roles",['filter' => 'AuthCheck'], function ($routes) {
  $routes->get("show", "Role::index");
  $routes->post("create", "Role::insert");
  $routes->get("edit/(:num)", "Role::singleRole/$1");
  $routes->post("update", "Role::update");
  $routes->get("delete/(:num)", "Role::delete/$1");
});

//GROUP ROUTES
$routes->group("userStatus",['filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "UserStatus::index");
  $routes->get("show", "UserStatus::index");
  $routes->get("edit/(:num)", "UserStatus::singleUserStatus/$1");
  $routes->get("delete/(:num)", "UserStatus::delete/$1");
  $routes->post("add", "UserStatus::create");
  $routes->post("update", "UserStatus::update");
});

//GROUP ROUTES MODULES
$routes->group("module",['filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "Module::index");
  $routes->get("show", "Module::index");
  $routes->get("edit/(:num)", "Module::singleModule/$1");
  $routes->get("delete/(:num)", "Module::delete/$1");
  $routes->post("add", "Module::create");
  $routes->post("update", "Module::update");
});

//GROUP ROUTES PERMISSION
$routes->group("permission",['filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "Permission::index");
  $routes->get("show", "Permission::index");
  $routes->get("edit/(:num)", "Permission::singlePermission/$1");
  $routes->get("delete/(:num)", "Permission::delete/$1");
  $routes->post("add", "Permission::create");
  $routes->post("update", "Permission::update");
});

//GROUP ROUTES ROLE
$routes->group("role",['filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "Role::index");
  $routes->get("show", "Role::index");
  $routes->get("edit/(:num)", "Role::singleRole/$1");
  $routes->get("delete/(:num)", "Role::delete/$1");
  $routes->post("add", "Role::create");
  $routes->post("update", "Role::update");
});
//GROUP ROUTES ROLE MODULES
$routes->group("roleModule",['filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "RoleModule::index");
  $routes->get("show", "RoleModule::index");
  $routes->get("edit/(:num)", "RoleModule::singleRoleModule/$1");
  $routes->get("editPermission/(:num)", "RoleModule::singlePermissionsModuleId/$1");
  $routes->get("editModules/(:num)", "RoleModule::singleRoleModuleId/$1");
  $routes->get("delete/(:num)", "RoleModule::delete/$1");
  $routes->post("add", "RoleModule::create");
  $routes->post("update", "RoleModule::update");
});

//GROUP ROUTES USER
$routes->group("user",['filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "User::index");
  $routes->get("show", "User::index");
  $routes->get("edit/(:num)", "User::singleUser/$1");
  $routes->get("delete/(:num)", "User::delete/$1");
  $routes->post("add", "User::create");
  $routes->post("update", "User::update");
});

//GROUP ROUTES
$routes->group("profile",['filter' => 'AuthCheck'], function ($routes) {
  $routes->get("show/(:num)", "Profile::index/$1");
  // $routes->post("create", "Role::insert");
  // $routes->get("edit/(:num)", "Role::singleRole/$1");
  // $routes->post("update", "Role::update");
  // $routes->get("delete/(:num)", "Role::delete/$1");
});

//GROUP ROUTES LOGIN
$routes->group("login", function ($routes) {
  $routes->get("/", "Login::index",['filter' => 'AlreadyLoggedIn']);
  $routes->get("show", "Login::index",['filter' => 'AlreadyLoggedIn']);
  $routes->post("logIn", "Login::logIn");
  $routes->post("singOff", "Login::singOff");
  $routes->post("forgerPassword", "Login::forgerPassword");
});


//GROUP ROUTES DASHBOARD
$routes->group("dashboard", function ($routes) {
  $routes->get("/", "Dashboard::index",['filter' => 'AuthCheck']);

});

$routes->get("/", "Login::index",['filter' => 'AlreadyLoggedIn']);




