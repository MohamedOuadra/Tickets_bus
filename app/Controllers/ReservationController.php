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
   
    {
        $reservationModel = new ReservationModel();
        
        // Récupérer les réservations avec les détails
        $data['reservations'] = $reservationModel->getReservationDetails();

        // Charger la vue avec les données
        return view('Reservation_view', $data);
    }
    
    public function delete()
{
    if ($this->request->getMethod() === 'POST') {
        $id_reservation = $this->request->getPost('id_reservation');

        if (!$id_reservation) {
            session()->setFlashdata('error', 'Aucun ID de réservation fourni.');
            return redirect()->to('/Reservation');
        }

        $reservationModel = new ReservationModel();
        $SiegeReservationModel = new SiegeReservationModel();

        // Vérifier que la réservation existe
        $reservation = $reservationModel->where('id_reservation', $id_reservation)->first();
        if (!$reservation) {
            session()->setFlashdata('error', 'La réservation n\'existe pas.');
            return redirect()->to('/Reservation');
        }

        try {
            // Suppression des enregistrements liés dans `siege_reservations`
            $SiegeReservationModel->where('id_reservation', $id_reservation)->delete();

            // Suppression de l'entrée principale dans `reservations`
            if ($reservationModel->where('id_reservation', $id_reservation)->delete()) {
                session()->setFlashdata('success', 'Réservation supprimée avec succès!');
            } else {
                session()->setFlashdata('error', 'Impossible de supprimer la réservation.');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }

        return redirect()->to('/Reservation');
    }

    return $this->response->setStatusCode(405)->setBody('Méthode non autorisée.');
}
public function update()
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
            'id_siege' => '',
            'argg' => ''

        ];

        return view('edit_reservation', $data);
    }

    // Si la méthode n'est pas POST, renvoyer une erreur 405
    return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
}
// public function update_siege()
// {
//     if ($this->request->getMethod() === 'POST') {

//         $SiegeReservationModel = new SiegeReservationModel();
//         $SiegeModel = new SiegeModel();

//         $selected_seat = $this->request->getPost('selected_seat'); 
//         $id_client = $this->request->getPost('id_client'); 
//         $id_siege = $this->request->getPost('id_siege');
//         $id_route = $this->request->getPost('id_route');  
//         $id_bus = $this->request->getPost('id_bus');  
//         $date_depart = $this->request->getPost('date_depart'); 
        
//         $Siege = $SiegeModel
//             ->select('id_siege')
//             ->where('sieges.id_bus', $id_bus)
//             ->where('sieges.numero_siege', $selected_seat)
//             ->first(); 
//         $argg = 'hjahjss' ;

//         // Vérifier les bus disponibles pour cette route
//         // $siegereserve = $SiegeReservationModel
//         //     ->select('id_siege')
//         //     ->join('reservations AS res', 'res.id_reservation = siege_reservations.id_reservation')  // Alias 'res' pour reservations
//         //     ->join('clients AS cl', 'cl.id_client = reservations.id_client')
//         //     ->join('bus_routes AS br', 'br.id_route = res.id_route')  // Alias 'br' pour bus_routes
//         //     ->join('sieges AS sg', 'sg.id_siege = siege_reservations.id_siege')
//         //     ->join('buses AS bs', 'bs.id_bus = sg.id_bus')
//         //     ->where('br.id_route', $id_route)  // Utilisation de l'alias 'br'
//         //     ->where('siege_reservations.date_depart', $date_depart)
//         //     ->where('siege_reservations.id_siege', $id_siege)
//         //     ->where('siege_reservations.id_client', $id_client)
//         //     ->where('bs.id_bus', $id_bus)
//         //     ->first();

//         $data = [
//             'id_siege' => $Siege,
//             'argg' => $argg,
//             // 'updated_at'    => date('Y-m-d H:i:s'),
//         ];

//         // if ($SiegeReservationModel->update($siegereserve, $data)) {
//         //     // Ajouter un message de succès dans la session flashdata
//         //     session()->setFlashdata('success', 'Bus updated successfully!');
//         // } else {
//         //     // Ajouter un message d'erreur dans la session flashdata
//         //     session()->setFlashdata('error', 'Failed to update Bus.');
//         // }

//         // Redirection vers /buses
//         // return redirect()->to('/Reservation');

//         return view('edit_reservation', $data);
//     }

//     // Si la méthode n'est pas POST, renvoyer une erreur 405

//     return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
// }



    
    

}
