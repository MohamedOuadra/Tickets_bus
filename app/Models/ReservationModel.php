<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table            = 'reservations';
    protected $primaryKey       = 'id_reservation';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_siege',
        'id_client',
        'id_route',
        'ticket_code',
        'date_reservation',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // public function getReservationsWithDetails()
    // {  
    //     return $this->select('reservations.* , bus_routes.prix , buses.nom_bus , siege_reservations.id_siege , siege_reservations.date_depart , sieges.numero_siege , routes.ville_depart, routes.ville_arrivee , clients.nom_client , clients.prenom_client , clients.telephone_client')
    //                 ->join('siege_reservations', 'siege_reservations.id_reservation = reservations.id_reservation')
    //                 ->join('routes', 'routes.id_route = bus_routes.id_route')
    //                 ->join('sieges', 'sieges.id_siege = siege_reservations.id_siege')
    //                 ->join('buses', 'buses.id_bus = sieges.id_bus')
    //                 ->join('routes', 'routes.id_route = reservations.id_route')
    //                 ->join('clients', 'clients.id_client = reservations.id_client')
    //                 ->findAll();
    // }
    public function getReservationDetails()
    {
        return $this->select('
            reservations.ticket_code, 
            clients.nom_client, 
            clients.telephone_client, 
            buses.nom_bus, 
            routes.ville_depart, 
            routes.ville_arrivee, 
            sieges.numero_siege, 
            reservations.date_reservation,
            bus_routes.prix, 
            siege_reservations.date_depart
        ')
        ->join('clients', 'clients.id_client = reservations.id_client')
        ->join('sieges', 'sieges.id_siege = reservations.id_siege')
        ->join('buses', 'buses.id_bus = sieges.id_bus')
        ->join('routes', 'routes.id_route = reservations.id_route')
        ->join('bus_routes', 'bus_routes.id_route = reservations.id_route AND bus_routes.id_bus = sieges.id_bus', 'left')
        ->join('siege_reservations', 'siege_reservations.id_siege = reservations.id_siege', 'left')
        ->findAll();
    }

    // public function getReservationsWithDetails()
    // {
    //     return $this->select('reservations.*, sieges.numero_siege, clients.nom_client, clients.telephone_client, 
    //                           routes.ville_depart, routes.ville_arrivee, siege_reservations.date_depart')
    //                 ->join('sieges', 'sieges.id_siege = reservations.id_siege')
    //                 ->join('clients', 'clients.id_client = reservations.id_client')
    //                 ->join('routes', 'routes.id_route = reservations.id_route')
    //                 ->join('siege_reservations', 'siege_reservations.id_reservation = reservations.id_reservation', 'left')
    //                 ->findAll();
    // }
    // public function getReservationsWithDetails()
    // {
    //     return $this->select('
    //             reservations.*, 
    //             sieges.numero_siege, 
    //             clients.nom_client, 
    //             clients.telephone_client, 
    //             routes.ville_depart, 
    //             routes.ville_arrivee, 
    //             siege_reservations.date_depart,
    //             buses.id_bus, 
    //             buses.nom_bus')
    //         ->join('sieges', 'sieges.id_siege = reservations.id_siege')
    //         ->join('clients', 'clients.id_client = reservations.id_client')
    //         ->join('routes', 'routes.id_route = reservations.id_route')
    //         ->join('siege_reservations', 'siege_reservations.id_reservation = reservations.id_reservation', 'left')
    //         ->join('buses', 'buses.id_bus = sieges.id_bus') // Join avec la table buses pour récupérer id_bus
    //         ->findAll();
    // }

}
