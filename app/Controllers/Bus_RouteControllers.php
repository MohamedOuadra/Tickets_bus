<?php

namespace App\Controllers;

use App\Models\BusRouteModel;
use App\Models\BusModel;
use App\Models\RouteModel;

class Bus_RouteControllers extends BaseController
{
    public function index()
    {
        // Instancier le modèle
        $busRouteModel = new BusRouteModel();
        $busModel = new BusModel();
        $routeModel = new RouteModel();

        // Récupérer les données de la table `buses`
        $data['bus_routes'] = $busRouteModel->getBusRoutesWithDetails();
        $data['buses'] = $busModel->findAll();
        $data['routes'] = $routeModel->findAll();

        // Charger la vue et passer les données
        return view('Bus_Route_view', $data);
    }
    public function add()
    {
        if ($this->request->getMethod() === 'POST') {

            $busRouteModel = new BusRouteModel();

            // Récupération des données depuis le formulaire
            $data = [
                'id_bus' => $this->request->getPost('id_bus'),
                'id_route' => $this->request->getPost('id_route'),
                'heure_depart' => $this->request->getPost('heure_depart'),
                'heure_arrivee' => $this->request->getPost('heure_arrivee'),
                'prix' => $this->request->getPost('prix'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Tentative d'insertion dans la base
            if ($busRouteModel->insert($data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Bus added successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to add Bus.');
            }

            // Redirection vers /buses
            return redirect()->to('/bus_route');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }
    public function update()
    {
        if ($this->request->getMethod() === 'POST') {

            $busRouteModel = new BusRouteModel();

            // Récupérer les données depuis le formulaire
            $id_bus_route = $this->request->getPost('id_bus_route');
            $data = [
                'id_bus' => $this->request->getPost('id_bus'),
                'id_route' => $this->request->getPost('id_route'),
                'heure_depart' => $this->request->getPost('heure_depart'),
                'heure_arrivee' => $this->request->getPost('heure_arrivee'),
                'prix' => $this->request->getPost('prix'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Mise à jour de la Bus
            if ($busRouteModel->update($id_bus_route, $data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Bus updated successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to update Bus.');
            }

            // Redirection vers /buses
            return redirect()->to('/bus_route');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }
    public function delete()
    {
        if ($this->request->getMethod() === 'POST') {

            $busRouteModel = new BusRouteModel();

            // Récupérer l'ID de la Bus à supprimer
            $id_bus_route = $this->request->getPost('id_bus_route');

            // Tentative de suppression de la Bus
            if ($busRouteModel->delete($id_bus_route)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Bus deleted successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to delete Bus.');
            }

            // Redirection vers /buses
            return redirect()->to('/bus_route');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }
    
    

}
