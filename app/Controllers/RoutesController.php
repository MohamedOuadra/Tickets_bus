<?php

namespace App\Controllers;

use App\Models\RouteModel;

class RoutesController extends BaseController
{
    public function index()
    {
        // Instancier le modèle
        $routeModel = new RouteModel();

        // Récupérer les données de la table `routes`
        $data['routes'] = $routeModel->findAll();

        // Charger la vue et passer les données
        return view('routes_view', $data);
    }
    
    public function add()
    {
        if ($this->request->getMethod() === 'POST') {
            $routeModel = new RouteModel();

            // Récupération des données depuis le formulaire
            $data = [
                'ville_depart' => $this->request->getPost('ville_depart'),
                'ville_arrivee' => $this->request->getPost('ville_arrivee'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Tentative d'insertion dans la base
            if ($routeModel->insert($data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Route added successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to add route.');
            }

            // Redirection vers /routes
            return redirect()->to('/routes');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }
    public function update()
    {
        if ($this->request->getMethod() === 'POST') {
            $routeModel = new RouteModel();

            // Récupérer les données depuis le formulaire
            $id_route = $this->request->getPost('id_route');
            $data = [
                'ville_depart'  => $this->request->getPost('ville_depart'),
                'ville_arrivee' => $this->request->getPost('ville_arrivee'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Mise à jour de la route
            if ($routeModel->update($id_route, $data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Route updated successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to update route.');
            }

            // Redirection vers /routes
            return redirect()->to('/routes');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }

    public function delete()
    {
        if ($this->request->getMethod() === 'POST') {
            $routeModel = new RouteModel();

            // Récupérer l'ID de la route à supprimer
            $id_route = $this->request->getPost('id_route');

            // Tentative de suppression de la route
            if ($routeModel->delete($id_route)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Route deleted successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to delete route.');
            }

            // Redirection vers /routes
            return redirect()->to('/routes');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }





}
