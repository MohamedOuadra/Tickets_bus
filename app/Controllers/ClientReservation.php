<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BusModel;
use App\Models\BusRouteModel;
use App\Models\ReservationModel;
use App\Models\RouteModel;
use App\Models\SiegeModel;
use App\Models\SiegeReservationModel;
use CodeIgniter\HTTP\ResponseInterface;

class ClientReservation extends BaseController
{
    public function index()
    {

        // Charger le modèle
        $routeModel = new RouteModel();

        // Récupérer toutes les données de la table routes
        $routes = $routeModel->findAll();
        $data = [
            
            'routes' => $routes,
            'dateDepart' => '',

        ];

        // Passer les données à la vue
        return view('client_reservation_view', $data);
        
        // $SiegeReservationModel = new SiegeReservationModel();
        // $busRouteModel = new BusRouteModel();
        
        // $busRoutes = [];
    
        // $data = [
        //     'SiegeReservations' => $SiegeReservationModel->getSiegesreservesWithDetails(),
        //     'BusRoutes' => $busRoutes,
        // ];
    
        // return view('client_reservation_view', $data);
    }

    public function search()
{

    // Charger le modèle pour les routes
    $routeModel = new RouteModel();
    $routes = $routeModel->findAll();

    if ($this->request->getMethod() === 'POST') {
        $SiegeReservationModel = new SiegeReservationModel();
        

        $routeId = $this->request->getPost('route');
        $dateDepart = $this->request->getPost('date_depart');  

        $busRouteModel = new BusRouteModel();
        $busRoutes = $busRouteModel
            ->where('bus_routes.id_route', $routeId)  // Utilisation de l'alias 'br'
            // ->where('siege_reservations.date_depart', $dateDepart)
            ->getSiegeWithDetails();
        
        $availableSeats = $SiegeReservationModel->getSiegesreservesWithDetails();
        

        foreach ($busRoutes as $bus) {

        $heureDepart = new \DateTime($bus['heure_depart']);
        $heureArrivee = new \DateTime($bus['heure_arrivee']);
        $interval = $heureDepart->diff($heureArrivee);

        $duration = $interval->h . 'h ' . $interval->i . 'm';
        // Ajoutez le prix à l'HTML
        }

        if (empty($busRoutes) || empty($availableSeats)) {
            // Aucun bus disponible ou pas de réservations pour cette date
            return redirect()->back()->with('error', 'Aucun bus trouvé pour cette route et cette date.');
        }

        // Passer les données à la vue
        $data = [
            'SiegeReservations' => $availableSeats,
            'BusRoutes' => $busRoutes,
            'routes' => $routes,
            'dateDepart' => $dateDepart,

        ];

        return view('client_reservation_view', $data);
    }

    // Si la méthode n'est pas POST, renvoyer une erreur 405
    return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
}


public function showSeats()
{

    if ($this->request->getMethod() === 'POST') {

        $SiegeReservationModel = new SiegeReservationModel();
        $SiegeModel = new SiegeModel();
        $reservationModel = new ReservationModel();
        
        $id_siege = $this->request->getPost('id_siege');
        $id_route = $this->request->getPost('id_route');  
        $id_bus = $this->request->getPost('id_bus');  
        $date_depart = $this->request->getPost('date_depart'); 
        $id_reservation = $this->request->getPost('id_reservation'); 

        
        $Siege = $SiegeModel->where('sieges.id_bus', $id_bus)
                ->findAll();

        $siegereserve = $SiegeReservationModel
            ->join('reservations AS res', 'res.id_reservation = siege_reservations.id_reservation')
            ->join('bus_routes AS br', 'br.id_route = res.id_route')
            ->join('sieges AS sg', 'sg.id_siege = siege_reservations.id_siege')
            ->join('buses AS bs', 'bs.id_bus = sg.id_bus')
            ->where('br.id_route', $id_route)
            ->where('siege_reservations.date_depart', $date_depart)
            ->where('bs.id_bus', $id_bus)
            ->getSiegesreservesWithDetails();
            

        $data = [
            'siegereserves' => $siegereserve,
            'Sieges' => $Siege,
            'id_route' => $id_route,
            'dateDepart' => $date_depart,
        ];

        return view('client_reservation_view', $data);
    }

    // Si la méthode n'est pas POST, renvoyer une erreur 405
    return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
}

public function reserveSeat()
    {
        if ($this->request->getMethod() === 'POST') {
            // Récupérer les données envoyées par le formulaire
            $selected_seat = $this->request->getPost('selected_seat'); 
            $id_client = $this->request->getPost('id_client'); 
            $id_siege = $this->request->getPost('id_siege');
            $id_route = $this->request->getPost('id_route');  
            $id_bus = $this->request->getPost('id_bus');  
            $date_depart = $this->request->getPost('date_depart'); 
            $idd_siege_reservation = $this->request->getPost('id_siege_reservation'); 
            $id_reservation = $this->request->getPost('id_reservation'); 
            $id_reservation_current = $this->request->getPost('id_reservation_current'); 


            $SiegeReservationModel = new SiegeReservationModel();
            $ReservationModel = new ReservationModel();
            $SiegeModel = new SiegeModel();

            if (!$selected_seat || !$id_client || !$id_siege || !$id_route || !$id_bus || !$date_depart) {
                return $this->response->setStatusCode(400)->setJSON([
                    'status' => 'error',
                    'message' => 'Veuillez remplir tous les champs requis.'
                ]);
            }

            $Siege = $SiegeModel
            ->where('sieges.id_bus', $id_bus)
            ->where('sieges.numero_siege', $selected_seat)
            ->first();  

            if (!$Siege) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => 'error',
                    'message' => 'Le siège sélectionné est introuvable.'
                ]);
            }   
    
            $siegereserve = $SiegeReservationModel
                ->where('siege_reservations.id_siege', $id_siege)
                ->first();
    
            if (!$siegereserve) {
                return $this->response->setStatusCode(404)->setJSON([
                    'status' => 'error',
                    'message' => 'La réservation correspondante est introuvable.'
                ]);
            }
            
            $reservation = $ReservationModel
                ->where('reservations.id_siege', $id_siege)
                ->first();
    

            // Créer la réservation
            $reservationData = [
                'id_siege' => $Siege['id_siege'],
                'id_client' => 3,
                'id_route' => $reservation['id_route'],
                'ticket_code' => strtoupper(uniqid('TICKET_')), // Génération d'un code de ticket unique
                'date_reservation' => date('Y-m-d H:i:s'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Insertion de la réservation
            if ($ReservationModel->insert($reservationData)) {
                // Récupérer l'ID de la réservation insérée
                $reservationId = $ReservationModel->getInsertID();

                // Ajouter la réservation dans la table siege_reservations
                $siegeReservationData = [
                    'id_reservation' => $reservation['id_reservation'],
                    'id_siege' => $Siege['id_siege'],
                    'date_depart' => $date_depart,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ];

                // Insertion dans siege_reservations
                if ($SiegeReservationModel->insert($siegeReservationData)) {
                    session()->setFlashdata('success', 'Bus updated successfully!');
                }else {
                    session()->setFlashdata('error', 'Failed to update Bus.');
                }
                
            }else {
                session()->setFlashdata('error', 'Failed to update Bus.');
            }

            return redirect()->to('/reservations/3');
        }

        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }







    // public function getAvailableSeats()
    // {
    //     $busId = $this->request->getVar('bus_id');
    //     $routeId = $this->request->getVar('route_id');
    //     $date = $this->request->getVar('date');

    //     $siegeModel = new SiegeModel();

    //     $seats = $siegeModel
    //         ->where('id_bus', $busId)
    //         ->where('id_route', $routeId)
    //         ->where('date_reservation !=', $date) // Siège non réservé
    //         ->findAll();

    //     if ($seats) {
    //         return $this->response->setJSON(['success' => true, 'seats' => $seats]);
    //     } else {
    //         return $this->response->setJSON(['success' => false, 'message' => 'Aucun siège disponible.']);
    //     }
    // }

}


