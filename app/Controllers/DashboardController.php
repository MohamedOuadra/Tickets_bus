<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\BusModel;
use App\Models\ReservationModel;
use App\Models\RouteModel;
use App\Models\SiegeModel;
use App\Models\SiegeReservationModel;
use App\Models\BusRouteModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $ClientModel = new ClientModel();
        $BusModel = new BusModel();
        $reservationModel = new ReservationModel();
        $RouteModel = new RouteModel();
        $SiegeModel = new SiegeModel();
        $SiegeReservationModel = new SiegeReservationModel();
        $BusRouteModel = new BusRouteModel();

        $reservations = $reservationModel
            ->getReservationDetails();
        $earning = 0 ;
        foreach ($reservations as $reservation):
                $earning += $reservation['prix'] ;
        endforeach; 


        $count_client = $ClientModel->countAll();
        $count_bus = $BusModel->countAll();
        $count_reservation = $reservationModel->countAll();
        $count_route = $RouteModel->countAll();
        $count_siege = $SiegeModel->countAll();
        $count_siegereservation = $SiegeReservationModel->countAll();
        $count_bus_route = $BusRouteModel->countAll();

        $data = [
            'count_client' => $count_client,
            'count_bus' => $count_bus,
            'count_reservation' => $count_reservation,
            'count_route' => $count_route,
            'count_siege' => $count_siege,
            'count_siegereservation' => $count_siegereservation,
            'count_bus_route' => $count_bus_route,
            'earning' => $earning,
        ];
        return view('Dashboard',$data);
    }

}
