<?php

use App\Controllers\Auth;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 // $routes->setAutoRoute(true);

$routes->get('/', 'DashboardController::index');

$routes->get('routes', 'RoutesController::index');
$routes->post('routes/add', 'RoutesController::add');
$routes->post('routes/update', 'RoutesController::update');
$routes->post('routes/delete', 'RoutesController::delete');

$routes->get('buses', 'BusesController::index');
$routes->post('buses/add', 'BusesController::add');
$routes->post('buses/update', 'BusesController::update');
$routes->post('buses/delete', 'BusesController::delete');

$routes->get('bus_route', 'Bus_RouteControllers::index');
$routes->post('bus_route/add', 'Bus_RouteControllers::add');
$routes->post('bus_route/update', 'Bus_RouteControllers::update');
$routes->post('bus_route/delete', 'Bus_RouteControllers::delete');

$routes->get('Customers', 'CustomersControllers::index');
$routes->post('Customers/add', 'CustomersControllers::add');
$routes->post('Customers/update', 'CustomersControllers::update');
$routes->post('Customers/delete', 'CustomersControllers::delete');

$routes->get('Reservation', 'ReservationController::index');
$routes->post('Reservation/add', 'ReservationController::add');
$routes->post('Reservation/update', 'ReservationController::update');
$routes->post('Reservation/delete', 'ReservationController::delete');





