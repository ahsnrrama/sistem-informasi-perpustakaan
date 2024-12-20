<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

// user
$routes->get('/', 'Home::index');

// // admin
// $routes->get('/admin', 'Admin::index');

// // login
// $routes->get('/login', 'Auth::login');
