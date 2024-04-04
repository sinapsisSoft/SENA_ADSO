<?php

return [
  '/' => [
    'controller' => App\Controllers\Login\LoginController::class,
    'method' => 'show'
  ],
  '/user' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'show'
  ],
  '/user/create' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'create'
  ],
  '/user/edit/:id' => [
    'controller' => App\Controllers\User\UserController::class,
    'method' => 'edit'
  ]
];
