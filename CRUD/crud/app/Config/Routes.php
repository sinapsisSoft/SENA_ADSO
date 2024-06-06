<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// CRUD RESTful Routes
$routes->get('profiles-list', 'Profile::index');
$routes->get('profile-form', 'Profile::create');
$routes->post('submit-form', 'Profile::store');
$routes->get('edit-view/(:num)', 'Profile::singleProfile/$1');
$routes->post('update', 'Profile::update');
$routes->get('delete/(:num)', 'Profile::delete/$1');