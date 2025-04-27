<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();


/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();


//GROUP ROUTES
$routes->group("userStatus",['namespace' => 'App\Controllers\User','filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "UserStatus::index");
  $routes->get("show", "UserStatus::index");
  $routes->get("edit/(:num)", "UserStatus::singleUserStatus/$1");
  $routes->get("delete/(:num)", "UserStatus::delete/$1");
  $routes->post("add", "UserStatus::create");
  $routes->post("update", "UserStatus::update");
});

//GROUP ROUTES DOCUMENTS TYPE
$routes->group("documentTypes",['namespace' => 'App\Controllers\DocumentTypes','filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "DocumentTypes::index");
  $routes->get("show", "DocumentTypes::index");
  $routes->get("edit/(:num)", "DocumentTypes::singleDocumentTypes/$1");
  $routes->get("delete/(:num)", "DocumentTypes::delete/$1");
  $routes->post("add", "DocumentTypes::create");
  $routes->post("update", "DocumentTypes::update");
});

//GROUP ROUTES MODULES
$routes->group("module",['namespace' => 'App\Controllers\Module','filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "Module::index");
  $routes->get("show", "Module::index");
  $routes->get("edit/(:num)", "Module::singleModule/$1");
  $routes->get("delete/(:num)", "Module::delete/$1");
  $routes->post("add", "Module::create");
  $routes->post("update", "Module::update");
});

//GROUP ROUTES PERMISSION
$routes->group("permission",['namespace' => 'App\Controllers\Permission','filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "Permission::index");
  $routes->get("show", "Permission::index");
  $routes->get("edit/(:num)", "Permission::singlePermission/$1");
  $routes->get("delete/(:num)", "Permission::delete/$1");
  $routes->post("add", "Permission::create");
  $routes->post("update", "Permission::update");
});

//GROUP ROUTES ROLE
$routes->group("role",['namespace' => 'App\Controllers\Role','filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "Role::index");
  $routes->get("show", "Role::index");
  $routes->get("edit/(:num)", "Role::singleRole/$1");
  $routes->get("delete/(:num)", "Role::delete/$1");
  $routes->post("add", "Role::create");
  $routes->post("update", "Role::update");
});


//GROUP ROUTES ROLE MODULES
$routes->group("roleModule",['namespace' => 'App\Controllers\Role','filter' => 'AuthCheck'],function($routes){
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
$routes->group("user",['namespace' => 'App\Controllers\User','filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "User::index");
  $routes->get("show", "User::index");
  $routes->get("edit/(:num)", "User::singleUser/$1");
  $routes->get("delete/(:num)", "User::delete/$1");
  $routes->post("add", "User::create");
  $routes->post("update", "User::update");
});

//GROUP ROUTES STUDENT
$routes->group("student",['namespace' => 'App\Controllers\Student','filter' => 'AuthCheck'],function($routes){
  $routes->get("/", "Student::index");
  $routes->get("show", "Student::index");
  $routes->get("edit/(:num)", "Student::singleStudent/$1");
  $routes->get("delete/(:num)", "Student::delete/$1");
  $routes->post("add", "Student::create");
  $routes->post("update", "Student::update");
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
$routes->group("login",['namespace' => 'App\Controllers\Login'], function ($routes) {
  $routes->get("/", "Login::index",['filter' => 'AlreadyLoggedIn']);
  $routes->get("show", "Login::index",['filter' => 'AlreadyLoggedIn']);
  $routes->post("logIn", "Login::logIn");
  $routes->post("singOff", "Login::singOff");
  $routes->post("forgerPassword", "Login::forgerPassword");
});

//GROUP ROUTES DASHBOARD
$routes->group("dashboard",['namespace' => 'App\Controllers\Dashboard'],function ($routes) {
  $routes->get("/", "Dashboard::index",['filter' => 'AuthCheck']);

});

$routes->get('/', 'Login::index', ['namespace' => 'App\Controllers\Login','filter' => 'AlreadyLoggedIn']);
