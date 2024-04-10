<?php

/* This PHP code snippet is defining an array that maps different URL routes to specific controller
classes and methods in an MVC (Model-View-Controller) architecture. Each key in the array represents
a route, and the corresponding value is an array containing the controller class and method that
should be executed when that route is accessed. */
return [
  '/' => [
    'controller' => App\Controllers\Login\LoginController::class,
    'method' => 'show'
  ],
  '/user' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'index'
  ],
  '/user/create' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'create'
  ],
  '/user/show' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'show'
  ],
  '/user/showId' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'showId'
  ],
  '/user/edit' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'update'
  ],
  '/user/delete' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'delete'
  ]
];
