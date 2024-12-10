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



    // Récupérer les réservations actuelles d'un client spécifique
    public function getCurrentReservationsByClient($clientId)
    {
        return $this->asArray()
                    ->where('id_client', $clientId)
                    ->findAll();
    }
    
    public function getReservationDetails()
    {
        return $this->select('
            reservations.*,
            reservations.ticket_code,
            clients.id_client, 
            clients.nom_client, 
            clients.telephone_client, 
            buses.nom_bus,
            buses.id_bus, 
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
        ->groupBy('reservations.id_reservation') 
        ->findAll();
    }

    public function getUniqueReservationDetails()
{
    return $this->select('
            reservations.*,
            reservations.ticket_code,
            clients.id_client, 
            clients.nom_client, 
            clients.telephone_client, 
            buses.nom_bus,
            buses.id_bus, 
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
        ->distinct(); // Ensure unique rows are retrieved.
}


    
}
