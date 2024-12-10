<?php

namespace App\Controllers;

use App\Models\ReservationModel;

class HomeControllers extends BaseController
{
    public function index()
    {
        $data = [
            'reservations' => '',
        ];
        return view('home_page', $data);
    }
    
    public function show_pnr()
    {
        if ($this->request->getMethod() === 'POST') {
            $reservationModel = new ReservationModel();
            $pnr = $this->request->getPost('pnr');

            if ($pnr) {
                $reservation = $reservationModel
                    ->where('reservations.ticket_code', $pnr)
                    ->getReservationDetails();

                if ($reservation) {

                    $data = [
                        'reservations' => $reservation,
                    ];
                    return view('home_page', $data);

                } else {
                    return redirect()->to(base_url('home_pnr'))->with('error', 'No bookings found for this PNR code');
                }
            } else {
                return redirect()->to(base_url('home_pnr'))->with('error', 'Please enter a PNR code');
            }
        }

        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }
}
