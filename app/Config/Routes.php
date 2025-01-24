<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::login');
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'login']);
$routes->get('/inventator-dashboard', 'InventatorController::index', ['filter' => 'login']);
$routes->get('/user-dashboard', 'UserController::index', ['filter' => 'login']);

