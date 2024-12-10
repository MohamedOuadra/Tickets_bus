<?php

namespace App\Models;

use CodeIgniter\Model;

class SiegeReservationModel extends Model
{
    protected $table            = 'siege_reservations';
    protected $primaryKey       = 'id_siege_reservation';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_reservation', 'id_siege', 'date_depart'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [
        'id_reservation' => 'required|integer',
        'id_siege'       => 'required|integer',
        'date_depart'    => 'required|valid_date',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function getSiegesreservesWithDetails()
    {
    return $this->select('siege_reservations.*, clients.id_client, routes.id_route, buses.id_bus, buses.nom_bus, routes.ville_depart, routes.ville_arrivee, sieges.numero_siege')
                ->join('reservations', 'reservations.id_reservation = siege_reservations.id_reservation')
                ->join('clients', 'clients.id_client = reservations.id_client')
                ->join('sieges', 'sieges.id_siege = siege_reservations.id_siege')
                ->join('buses', 'buses.id_bus = sieges.id_bus')
                ->join('routes', 'routes.id_route = reservations.id_route')
                ->findAll();
    }
}
