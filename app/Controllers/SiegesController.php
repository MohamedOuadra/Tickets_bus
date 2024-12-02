<?php
namespace App\Controllers;

use App\Models\RouteModel;
use App\Models\BusRouteModel;
use App\Models\SiegeReservationModel;
use App\Models\ClientModel;
use App\Models\BusModel;
use App\Models\ReservationModel;
use App\Models\SiegeModel;

class SiegesController extends BaseController
{
public function index()
{
    $SiegeReservationModel = new SiegeReservationModel();
    $busRouteModel = new BusRouteModel();
    
    $busRoutes = [];

    $data = [
        'SiegeReservations' => $SiegeReservationModel->getSiegesreservesWithDetails(),
        'BusRoutes' => $busRoutes,
    ];

    return view('Siege_view', $data);
}



public function showbus()
{
    if ($this->request->getMethod() === 'POST') {
        $SiegeReservationModel = new SiegeReservationModel();

        $routeId = $this->request->getPost('route');
        $dateDepart = $this->request->getPost('date_depart');  

        // Vérifier les bus disponibles pour cette route
        $busRoutes = $SiegeReservationModel
            ->join('reservations AS res', 'res.id_reservation = siege_reservations.id_reservation')  // Alias 'res' pour reservations
            ->join('bus_routes AS br', 'br.id_route = res.id_route')  // Alias 'br' pour bus_routes
            ->where('br.id_route', $routeId)  // Utilisation de l'alias 'br'
            ->where('siege_reservations.date_depart', $dateDepart)
            ->getSiegesreservesWithDetails();
        
        $availableSeats = $SiegeReservationModel->getSiegesreservesWithDetails();


        if (empty($busRoutes) || empty($availableSeats)) {
            // Aucun bus disponible ou pas de réservations pour cette date
            return redirect()->back()->with('error', 'Aucun bus trouvé pour cette route et cette date.');
        }

        // Passer les données à la vue
        $data = [
            'SiegeReservations' => $availableSeats,
            'BusRoutes' => $busRoutes,
        ];

        return view('Siege_view', $data);
    }

    // Si la méthode n'est pas POST, renvoyer une erreur 405
    return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
}

public function showsiege()
{
    if ($this->request->getMethod() === 'POST') {

        $SiegeReservationModel = new SiegeReservationModel();
        $SiegeModel = new SiegeModel();

        

        $id_siege = $this->request->getPost('id_siege');
        $id_route = $this->request->getPost('id_route');  
        $id_bus = $this->request->getPost('id_bus');  
        $date_depart = $this->request->getPost('date_depart'); 
        
        $busRoutes = $SiegeReservationModel
            ->join('reservations AS res', 'res.id_reservation = siege_reservations.id_reservation')  // Alias 'res' pour reservations
            ->join('bus_routes AS br', 'br.id_route = res.id_route')  // Alias 'br' pour bus_routes
            ->where('br.id_route', $id_route)  // Utilisation de l'alias 'br'
            ->where('siege_reservations.date_depart', $date_depart)
            ->getSiegesreservesWithDetails();
        
        $availableSeats = $SiegeReservationModel->getSiegesreservesWithDetails();
        $Siege = $SiegeModel->where('sieges.id_bus', $id_bus)
                ->findAll();

        // Vérifier les bus disponibles pour cette route
        $siegereserve = $SiegeReservationModel
            ->join('reservations AS res', 'res.id_reservation = siege_reservations.id_reservation')  // Alias 'res' pour reservations
            ->join('bus_routes AS br', 'br.id_route = res.id_route')  // Alias 'br' pour bus_routes
            ->join('sieges AS sg', 'sg.id_siege = siege_reservations.id_siege')
            ->join('buses AS bs', 'bs.id_bus = sg.id_bus')
            ->where('br.id_route', $id_route)  // Utilisation de l'alias 'br'
            ->where('siege_reservations.date_depart', $date_depart)
            ->where('bs.id_bus', $id_bus)
            ->getSiegesreservesWithDetails();


        // if (empty($busRoutes) || empty($availableSeats)) {
        //     // Aucun bus disponible ou pas de réservations pour cette date
        //     return redirect()->back()->with('error', 'Aucun bus trouvé pour cette route et cette date.');
        // }

        // Passer les données à la vue
        $data = [
            'siegereserves' => $siegereserve,
            'SiegeReservations' => $availableSeats,
            'BusRoutes' => $busRoutes,
            'Sieges' => $Siege,

        ];

        return view('Siege_view', $data);
    }

    // Si la méthode n'est pas POST, renvoyer une erreur 405
    return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
}




}
