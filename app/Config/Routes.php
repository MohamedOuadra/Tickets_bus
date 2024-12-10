<?php


use CodeIgniter\Router\RouteCollection;
use App\Controllers\Auth;

/**
 * @var RouteCollection $routes
 */
$routes->get('auth/register', 'Auth::registerView');  
$routes->post('auth/register', 'Auth::register');     
$routes->get('auth/login', 'Auth::loginView');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');


$routes->get('home_pnr', 'HomeControllers::index');
$routes->post('home_pnr/show_pnr', 'HomeControllers::show_pnr');
    



$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('Dashboard', 'DashboardController::index');
    $routes->get('home', 'Home::index');
    $routes->get('routes', 'RoutesController::index');
    $routes->get('buses', 'BusesController::index');
    $routes->get('bus_route', 'Bus_RouteControllers::index');
    $routes->get('Customers', 'CustomersControllers::index');
    $routes->get('Reservation', 'ReservationController::index');
    $routes->group('sieges', function($routes) {

        $routes->get('/', 'SiegesController::index');
    
        $routes->post('showbus', 'SiegesController::showbus');
        $routes->post('showsiege', 'SiegesController::showsiege');
        $routes->post('update_date_depart', 'SiegesController::update_date_depart');
        
    });
});

$routes->get('reserver', 'ClientReservation::index');
$routes->get('/ClientReservation/search', 'ClientReservation::search');

$routes->post('/ClientReservation/search', 'ClientReservation::search');
$routes->get('/reservations/(:num)', 'GetReservationsClient::index/$1');
$routes->post('/reservations/update', 'GetReservationsClient::update');
$routes->post('reservations/update_siege', 'GetReservationsClient::update_siege');
$routes->post('/reservations/delete', 'GetReservationsClient::delete');

$routes->get('ClientReservation/getAvailableSeats', 'ClientReservation::getAvailableSeats');
$routes->post('ClientReservation/reserveSeat', 'ClientReservation::reserveSeat');
// $routes->post('ClientReservation/reserveSeat', 'ClientReservation::reserveSeat');
$routes->post('ClientReservation/showSeats', 'ClientReservation::showSeats');
$routes->post('/client_reservation/reserveSeat', 'ClientReservation::reserveSeat');

// changes

// $routes->setAutoRoute(true);



$routes->post('routes/add', 'RoutesController::add');
$routes->post('routes/update', 'RoutesController::update');
$routes->post('routes/delete', 'RoutesController::delete');

$routes->post('buses/add', 'BusesController::add');
$routes->post('buses/update', 'BusesController::update');
$routes->post('buses/delete', 'BusesController::delete');

$routes->post('bus_route/add', 'Bus_RouteControllers::add');
$routes->post('bus_route/update', 'Bus_RouteControllers::update');
$routes->post('bus_route/delete', 'Bus_RouteControllers::delete');

$routes->post('Customers/add', 'CustomersControllers::add');
$routes->post('Customers/update', 'CustomersControllers::update');
$routes->post('Customers/delete', 'CustomersControllers::delete');

$routes->post('Reservation/add', 'ReservationController::add');
$routes->post('Reservation/update', 'ReservationController::update');
$routes->post('Reservation/update_siege', 'ReservationController::update_siege');
$routes->post('Reservation/delete', 'ReservationController::delete');





