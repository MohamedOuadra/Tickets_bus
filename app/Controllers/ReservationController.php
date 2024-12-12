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
            session()->setFlashdata('error', 'No booking ID provided');
            return redirect()->to('/Reservation');
        }

        $reservationModel = new ReservationModel();
        $SiegeReservationModel = new SiegeReservationModel();

        // Vérifier que la réservation existe
        $reservation = $reservationModel->where('id_reservation', $id_reservation)->first();
        if (!$reservation) {
            session()->setFlashdata('error', 'The reservation does not exist');
            return redirect()->to('/Reservation');
        }

        try {
            // Suppression des enregistrements liés dans `siege_reservations`
            $SiegeReservationModel->where('id_reservation', $id_reservation)->delete();

            // Suppression de l'entrée principale dans `reservations`
            if ($reservationModel->where('id_reservation', $id_reservation)->delete()) {
                session()->setFlashdata('success', 'Reservation successfully deleted!');
            } else {
                session()->setFlashdata('error', 'Unable to delete the Reservation');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error deleting : ' . $e->getMessage());
        }

        return redirect()->to('/Reservation');
    }

    return $this->response->setStatusCode(405)->setBody('Method not allowed');
}

public function update()
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

        $reservation_current = $reservationModel
            ->where('reservations.id_reservation', $id_reservation)
            ->getReservationDetails();

        $data = [
            'siegereserves' => $siegereserve,
            'Sieges' => $Siege,
            'reservation_currents' => $reservation_current,
        ];

        return view('edit_reservation', $data);
    }

    return $this->response->setStatusCode(405)->setBody('Method Not Allowed');

}


public function update_siege()
{
    if ($this->request->getMethod() === 'POST') {

        $SiegeReservationModel = new SiegeReservationModel();
        $ReservationModel = new ReservationModel();
        $SiegeModel = new SiegeModel();

        $selected_seat = $this->request->getPost('selected_seat'); 
        $id_client = $this->request->getPost('id_client'); 
        $id_siege = $this->request->getPost('id_siege');
        $id_route = $this->request->getPost('id_route');  
        $id_bus = $this->request->getPost('id_bus');  
        $date_depart = $this->request->getPost('date_depart'); 
        $idd_siege_reservation = $this->request->getPost('id_siege_reservation'); 
        $id_reservation = $this->request->getPost('id_reservation'); 
        $id_reservation_current = $this->request->getPost('id_reservation_current'); 


        if (!$selected_seat || !$id_client || !$id_siege || !$id_route || !$id_bus || !$date_depart) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => 'error',
                'message' => 'Please fill in all required fields'
            ]);
        }

        $Siege = $SiegeModel
            ->where('sieges.id_bus', $id_bus)
            ->where('sieges.numero_siege', $selected_seat)
            ->first();    
        
        if (!$Siege) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'The selected seat was not found'
            ]);
        }   

        $siegereserve = $SiegeReservationModel
            ->where('siege_reservations.id_reservation', $id_reservation_current)
            ->first();

        if (!$siegereserve) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'The corresponding reservation cannot be found'
            ]);
        }
        
        $reservation = $ReservationModel
            ->where('reservations.id_reservation', $id_reservation_current)
            ->first();

        if (!$siegereserve) {
            return $this->response->setStatusCode(404)->setJSON([
                'status' => 'error',
                'message' => 'The corresponding reservation cannot be found'
            ]);
        }
        
        $data = [
            'id_siege' => $Siege['id_siege'],
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        if ($SiegeReservationModel->update($siegereserve['id_siege_reservation'], $data) &&  $ReservationModel->update($reservation['id_reservation'], $data)) {
            // Ajouter un message de succès dans la session flashdata
            session()->setFlashdata('success', 'Reservation updated successfully!');
        } else {
            // Ajouter un message d'erreur dans la session flashdata
            session()->setFlashdata('error', 'Failed to update Reservation');
        }

        return redirect()->to('/Reservation');

    }


    return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
}





    
    

}

