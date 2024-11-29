<?php

namespace App\Controllers;

use App\Models\BusModel;

class BusesController extends BaseController
{
    public function index()
    {
        // Instancier le modèle
        $busModel = new BusModel();

        // Récupérer les données de la table `buses`
        $data['buses'] = $busModel->findAll();

        // Charger la vue et passer les données
        return view('buses_view', $data);
    }
    
    public function add()
    {
        if ($this->request->getMethod() === 'POST') {
            $busModel = new BusModel();

            // Récupération des données depuis le formulaire
            $data = [
                'nom_bus' => $this->request->getPost('nom_bus'),
                'nombre_sieges' => $this->request->getPost('nombre_sieges'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Tentative d'insertion dans la base
            if ($busModel->insert($data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Bus added successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to add Bus.');
            }

            // Redirection vers /buses
            return redirect()->to('/buses');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }
    public function update()
    {
        if ($this->request->getMethod() === 'POST') {
            $busModel = new BusModel();

            // Récupérer les données depuis le formulaire
            $id_bus = $this->request->getPost('id_bus');
            $data = [
                'nom_bus'  => $this->request->getPost('nom_bus'),
                'nombre_sieges' => $this->request->getPost('nombre_sieges'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Mise à jour de la Bus
            if ($busModel->update($id_bus, $data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Bus updated successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to update Bus.');
            }

            // Redirection vers /buses
            return redirect()->to('/buses');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }

    public function delete()
    {
        if ($this->request->getMethod() === 'POST') {
            $busModel = new BusModel();

            // Récupérer l'ID de la Bus à supprimer
            $id_bus = $this->request->getPost('id_bus');

            // Tentative de suppression de la Bus
            if ($busModel->delete($id_bus)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Bus deleted successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to delete Bus.');
            }

            // Redirection vers /buses
            return redirect()->to('/buses');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }





}
