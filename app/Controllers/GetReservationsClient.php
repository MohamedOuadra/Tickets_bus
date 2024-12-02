<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReservationModel;
use CodeIgniter\HTTP\ResponseInterface;

class GetReservationsClient extends BaseController
{
    
    public function index($id_client)
    {
        // Initialisation du modèle
        $reservationModel = new ReservationModel();

        // Récupérer les réservations de l'utilisateur spécifique
        $data['reservations'] = $reservationModel->getUniqueReservationDetails()
            ->where('reservations.id_client', $id_client)  // Filtrer par id_client
            ->findAll();  // Retirer le "return" ici pour obtenir un tableau.

        // Passer les données à la vue
        return view('Reservation_client', $data);
    }
}
