<?php


use CodeIgniter\Router\RouteCollection;
use App\Controllers\Auth;

/**
 * @var RouteCollection $routes
 */
$routes->get('auth/register', 'Auth::registerView');  // To display the registration form
$routes->post('auth/register', 'Auth::register');      // To handle the form submission and store data in the database
$routes->get('auth/login', 'Auth::loginView');
$routes->post('auth/login', 'Auth::login');
$routes->get('reserver', 'ClientReservation::index');
$routes->post('/ClientReservation/search', 'ClientReservation::search');
$routes->get('/reservations/(:num)', 'GetReservationsClient::index/$1');
// $routes->post('ClientReservation/reserveSeat', 'ClientReservation::reserveSeat');
$routes->post('ClientReservation/showSeats', 'ClientReservation::showSeats');
$routes->post('/client_reservation/reserveSeat', 'ClientReservation::reserveSeat');



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



$routes->group('sieges', function($routes) {
    // Route pour afficher les routes dans le formulaire
    $routes->get('/', 'SiegesController::index');

    // Route pour afficher les bus et sièges en fonction de la route et de la date
    $routes->post('showbus', 'SiegesController::showbus');
    $routes->post('showsiege', 'SiegesController::showsiege');
});

