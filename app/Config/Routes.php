<?php

use App\Controllers\Auth;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('auth/register', 'Auth::registerView');  // To display the registration form
$routes->post('auth/register', 'Auth::register');      // To handle the form submission and store data in the database
$routes->get('auth/login', 'Auth::loginView');
$routes->post('auth/login', 'Auth::login');
