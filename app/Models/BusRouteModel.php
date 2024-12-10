<?php

namespace App\Models;

use CodeIgniter\Model;

class BusRouteModel extends Model
{
    protected $table            = 'bus_routes';
    protected $primaryKey       = 'id_bus_route';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_bus','id_route','heure_depart','heure_arrivee','prix'];
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

    public function getBusRoutesWithDetails()
    {
        return $this->select('bus_routes.*, buses.nom_bus, routes.ville_depart, routes.ville_arrivee')
                    ->join('buses', 'buses.id_bus = bus_routes.id_bus')
                    ->join('routes', 'routes.id_route = bus_routes.id_route')
                    ->findAll();
    }
    public function getSiegeWithDetails()
    {
        return $this->select('bus_routes.*, sieges.id_siege ,siege_reservations.date_depart, buses.nom_bus, routes.ville_depart, routes.ville_arrivee')
                    ->join('buses', 'buses.id_bus = bus_routes.id_bus')
                    ->join('routes', 'routes.id_route = bus_routes.id_route')
                    ->join('reservations', 'reservations.id_route = bus_routes.id_route')
                    ->join('sieges', 'sieges.id_siege = reservations.id_siege')
                    ->join('siege_reservations', 'siege_reservations.id_siege = sieges.id_siege ')
                    ->findAll();
    }
}

