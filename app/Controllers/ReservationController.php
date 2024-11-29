<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\BusModel;
use App\Models\ReservationModel;
use App\Models\RouteModel;
use App\Models\SiegeModel;
use App\Models\SiegeReservationModel;
use App\Models\BusRouteModel;


class ReservationController extends BaseController
{
    public function index()
    // {   
        
        
    //     // Instancier le modèle
    //     $BusModel = new BusModel();
    //     $RouteModel = new RouteModel();
    //     $ClientModel = new ClientModel();
    //     $ReservationModel = new ReservationModel();
    //     $SiegeModel = new SiegeModel();
    //     $SiegeReservationModel = new SiegeReservationModel();

    //     // Récupérer les données de la table `buses`
    //     $data['Reservations'] = $ReservationModel->getBusRoutesWithDetails();
    //     $data['buses'] = $BusModel->findAll();
    //     $data['clients'] = $ClientModel->findAll();
    //     $data['routes'] = $routeModel->findAll();
    //     $data['sieges'] = $SiegeModel->findAll();
    //     $data['SiegeReservations'] = $SiegeReservationModel->findAll();

    //     // Charger la vue et passer les données
    //     return view('Reservation_view', $data);
    // }
    // {
    //     // Charger les modèles
    //     $reservationModel = new ReservationModel();
    //     $siegeReservationModel = new SiegeReservationModel();
    //     $siegeModel = new SiegeModel();
    //     $routeModel = new RouteModel();
    //     $clientModel = new ClientModel();
    //     $busRouteModel = new BusRouteModel();
    //     // Récupérer la réservation
    //     $reservation = $reservationModel->findAll();

    //     // Trouver l'ID du bus via le siège 
    //     $siege = $siegeModel->find($reservation['id_siege']);
    //     $id_bus = $siege['id_bus']; // Récupérer l'ID du bus directement à partir du siège
        
    //     // Trouver l'enregistrement dans bus_routes avec l'ID du bus et de la route
    //     $busRoute = $busRouteModel->where('id_bus', $id_bus)->where('id_route', $reservation['id_route'])->first();

    //     // Si la réservation existe, continuez à chercher les autres informations
    //     if ($busRoute) {
    //         // Trouver les détails de la route
    //         $route = $routeModel->find($busRoute['id_route']);
            
    //         // Trouver le client
    //         $client = $clientModel->find($reservation['id_client']);
            
    //         // Trouver les détails du bus
    //         $bus = $busModel->find($id_bus);
            
    //         // Trouver les détails du siège
    //         $siege = $siegeModel->find($reservation['id_siege']);
            
    //         // Récupérer la date de départ depuis la table SiegeReservationModel
    //         $siegeReservation = $siegeReservationModel->where('id_siege', $reservation['id_siege'])->first();

    //         // Construction de l'affichage des informations
    //         $data = [
    //             'customer_name' => $client['nom_client'],
    //             'phone_number' => $client['telephone_client'],
    //             'bus_name' => $bus['nom_bus'],
    //             'route_name' => $route['ville_depart'] . ' - ' . $route['ville_arrivee'],
    //             'number_of_seat' => $siege['numero_siege'],
    //             'cost' => $busRoute['prix'],
    //             'date_depart' => $siegeReservation['date_depart'],
    //             'date_reservation' => $reservation['date_reservation'],
    //         ];
            
    //         // Affichage des données
    //         return view('reservation_view', $data);
    //     } else {
    //         // Gérer le cas où bus_route n'a pas été trouvé
    //         return 'Aucune réservation trouvée.';
    //     }

    // }
    // {
    //     $db = db_connect();

    //     $query = $db->table('reservations')
    //         ->select('
    //             reservations.ticket_code as ticket_bus,
    //             clients.nom_client,
    //             clients.prenom_client,
    //             clients.telephone_client,
    //             buses.nom_bus,
    //             routes.ville_depart,
    //             routes.ville_arrivee,
    //             sieges.numero_siege,
    //             bus_routes.prix,
    //             siege_reservations.date_depart,
    //             reservations.date_reservation
    //         ')
    //         ->join('clients', 'reservations.id_client = clients.id_client')
    //         ->join('siege_reservations', 'reservations.id_reservation = siege_reservations.id_reservation')
    //         ->join('sieges', 'siege_reservations.id_siege = sieges.id_siege')
    //         ->join('buses', 'sieges.id_bus = buses.id_bus')
    //         ->join('routes', 'reservations.id_route = routes.id_route')
    //         ->join('bus_routes', 'routes.id_route = bus_routes.id_route AND bus_routes.id_bus = buses.id_bus')
    //         ->get();

    //     $data['reservations'] = $query->getResultArray();

    //     return view('Reservation_view', $data);
    // }
    // {
    //     $db = \Config\Database::connect();

    //     // Requête pour récupérer les données nécessaires
    //     $query = $db->query("
    //         SELECT 
    //             reservations.ticket_code AS ticket_bus,
    //             CONCAT(clients.nom_client, ' ', clients.prenom_client) AS nom_complet,
    //             clients.telephone_client,
    //             buses.nom_bus,
    //             CONCAT(routes.ville_depart, ' -> ', routes.ville_arrivee) AS itineraire,
    //             sieges.numero_siege,
    //             bus_routes.prix,
    //             siege_reservations.date_depart,
    //             reservations.date_reservation
    //         FROM reservations
    //         JOIN clients ON reservations.id_client = clients.id_client
    //         JOIN buses ON reservations.id_bus = buses.id_bus
    //         JOIN routes ON reservations.id_route = routes.id_route
    //         JOIN bus_routes ON reservations.id_route = bus_routes.id_route AND reservations.id_bus = bus_routes.id_bus
    //         JOIN sieges ON reservations.id_siege = sieges.id_siege
    //         JOIN siege_reservations ON reservations.id_reservation = siege_reservations.id_reservation
    //     ");

    //     $data['reservations'] = $query->getResultArray();

    //     // Charger la vue et passer les données
    //     return view('Reservation_view', $data);
    // }

    {
        $reservationModel = new ReservationModel();
        
        // Récupérer les réservations avec les détails
        $data['reservations'] = $reservationModel->getReservationDetails();

        // Charger la vue avec les données
        return view('Reservation_view', $data);
    }

    // {
    //     $reservationModel = new ReservationModel();
    //     $busRouteModel = new BusRouteModel();

    //     // Récupérer les réservations avec les détails (y compris date_depart)
    //     $reservations = $reservationModel->getReservationsWithDetails();

    //     // Tableau pour stocker les réservations avec le prix
    //     $data = [];

    //     foreach ($reservations as $reservation) {
    //         // Récupérer le prix depuis la table bus_routes
    //         $busRoute = $busRouteModel->where('id_bus', $reservation['id_bus'])
    //                                   ->where('id_route', $reservation['id_route'])
    //                                   ->first();

    //         // Ajouter les données à $data, y compris le prix et la date_depart
    //         $data[] = [
    //             'ticket_code' => $reservation['ticket_code'],
    //             'nom_client' => $reservation['nom_client'],
    //             'telephone_client' => $reservation['telephone_client'],
    //             'nom_bus' => $reservation['nom_bus'], // Il est possible que tu aies une relation avec les buses, si pas, fais une jointure ici
    //             'ville_depart' => $reservation['ville_depart'],
    //             'ville_arrivee' => $reservation['ville_arrivee'],
    //             'numero_siege' => $reservation['numero_siege'],
    //             'prix' => $busRoute['prix'], // Ajout du prix récupéré
    //             'date_reservation' => $reservation['date_reservation'],
    //             'date_depart' => $reservation['date_depart'], // Ajout de la date_depart récupérée depuis siege_reservations
    //         ];
    //     }

    //     // Passer les données à la vue
    //     return view('Reservation_view', ['reservations' => $data]);
    // }
    // {
    //     $reservationModel = new ReservationModel();
    //     $BusRouteModel = new BusRouteModel();

    //     // Récupérer les réservations avec les détails (y compris date_depart et id_bus)
    //     $reservations = $reservationModel->getReservationsWithDetails();

    //     // Tableau pour stocker les réservations avec le prix
    //     $data = [];

    //     foreach ($reservations as $reservation) {
    //         // Récupérer le prix depuis la table bus_routes
    //         $busRoute = $BusRouteModel->where('id_bus', $reservation['id_bus'])
    //                                   ->where('id_route', $reservation['id_route'])
    //                                   ->first();

    //         // Ajouter les données à $data, y compris le prix et la date_depart
    //         $data[] = [
    //             'ticket_code' => $reservation['ticket_code'],
    //             'nom_client' => $reservation['nom_client'],
    //             'telephone_client' => $reservation['telephone_client'],
    //             'nom_bus' => $reservation['nom_bus'], // Nom du bus récupéré
    //             'ville_depart' => $reservation['ville_depart'],
    //             'ville_arrivee' => $reservation['ville_arrivee'],
    //             'numero_siege' => $reservation['numero_siege'],
    //             'prix' => $busRoute['prix'], // Ajout du prix récupéré
    //             'date_reservation' => $reservation['date_reservation'],
    //             'date_depart' => $reservation['date_depart'], // Ajout de la date_depart récupérée
    //         ];
    //     }

    //     // Passer les données à la vue
    //     return view('Reservation_view', ['reservations' => $data]);
    // }

    // {
    //     $reservationModel = new ReservationModel();
    //     $busRouteModel = new BusRouteModel();

    //     // Récupérer les réservations avec les détails (y compris date_depart et id_bus)
    //     $reservations = $reservationModel->getReservationsWithDetails();

    //     // Tableau pour stocker les réservations avec le prix
    //     $data = [];

    //     foreach ($reservations as $reservation) {
    //         // Récupérer le prix depuis la table bus_routes
    //         $busRoute = $busRouteModel->where('id_bus', $reservation['id_bus'])
    //                                   ->where('id_route', $reservation['id_route'])
    //                                   ->first();

    //         // Vérifier si $busRoute existe avant d'ajouter le prix
    //         if ($busRoute) {
    //             $prix = $busRoute['prix'];
    //         } else {
    //             // Si pas de correspondance trouvée, définir un prix par défaut ou null
    //             $prix = null; // ou un prix par défaut, comme 0, si nécessaire
    //         }

    //         // Ajouter les données à $data, y compris le prix et la date_depart
    //         $data[] = [
    //             'ticket_code' => $reservation['ticket_code'],
    //             'nom_client' => $reservation['nom_client'],
    //             'telephone_client' => $reservation['telephone_client'],
    //             'nom_bus' => $reservation['nom_bus'], // Nom du bus récupéré
    //             'ville_depart' => $reservation['ville_depart'],
    //             'ville_arrivee' => $reservation['ville_arrivee'],
    //             'numero_siege' => $reservation['numero_siege'],
    //             'prix' => $prix, // Ajout du prix récupéré (ou null si non trouvé)
    //             'date_reservation' => $reservation['date_reservation'],
    //             'date_depart' => $reservation['date_depart'], // Ajout de la date_depart récupérée
    //         ];
    //     }

    //     // Passer les données à la vue
    //     return view('Reservation_view', ['reservations' => $data]);
    // }
    
    // public function update()
    // {
    //     if ($this->request->getMethod() === 'POST') {

    //         $ReservationModel = new ReservationModel();

    //         // Récupérer les données depuis le formulaire
    //         $id_reservation = $this->request->getPost('id_reservation');
    //         $id_client = $this->request->getPost('id_client');

    //         function generateTicketCode($id_reservation, $id_client)
    //         {
    //             // Partie fixe du code (identifiant de votre système, ex. "TCKT")
    //             $prefix = "TCKT";

    //             // Ajout de l'horodatage actuel pour garantir l'unicité
    //             $timestamp = date('YmdHis'); // Format: AnnéeMoisJourHeureMinuteSeconde

    //             // Ajout d'un identifiant unique basé sur la réservation et le client
    //             $uniquePart = str_pad($id_reservation, 4, '0', STR_PAD_LEFT) . str_pad($id_client, 4, '0', STR_PAD_LEFT);

    //             // Génération finale
    //             return $prefix . '-' . $uniquePart . '-' . $timestamp;
    //         }

    //         $ticket_code = generateTicketCode($id_reservation, $id_client);

    //         $data = [
    //             'id_siege' => $this->request->getPost('id_siege'),
    //             'id_client' => $this->request->getPost('id_client'),
    //             'id_route' => $this->request->getPost('id_route'),
    //             'ticket_code' => $this->request->getPost('ticket_code'),
    //             'date_reservation' => $this->request->getPost('date_reservation'),
    //             'updated_at'    => date('Y-m-d H:i:s'),
    //         ];
            

    //         // Mise à jour de la Bus
    //         if ($ReservationModel->update($id_reservation, $data)) {
    //             // Ajouter un message de succès dans la session flashdata
    //             session()->setFlashdata('success', 'Booking updated successfully!');
    //         } else {
    //             // Ajouter un message d'erreur dans la session flashdata
    //             session()->setFlashdata('error', 'Failed to update Booking.');
    //         }

    //         // Redirection vers /buses
    //         return redirect()->to('/Reservation');
    //     }

    //     // Si la méthode n'est pas POST, renvoyer une erreur 405
    //     return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    // }
    // public function delete()
    // {
    //     if ($this->request->getMethod() === 'POST') {

    //         $ReservationModel = new ReservationModel();

    //         // Récupérer l'ID de la Bus à supprimer
    //         $id_reservation = $this->request->getPost('id_reservation');

    //         // Tentative de suppression de la Bus
    //         if ($ReservationModel->delete($id_reservation)) {
    //             // Ajouter un message de succès dans la session flashdata
    //             session()->setFlashdata('success', 'Booking deleted successfully!');
    //         } else {
    //             // Ajouter un message d'erreur dans la session flashdata
    //             session()->setFlashdata('error', 'Booking to delete Bus.');
    //         }

    //         // Redirection vers /buses
    //         return redirect()->to('/Reservation');
    //     }

    //     // Si la méthode n'est pas POST, renvoyer une erreur 405
    //     return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    // }
    
    

}
