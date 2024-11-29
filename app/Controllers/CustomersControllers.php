<?php

namespace App\Controllers;

use App\Models\ClientModel;

class CustomersControllers extends BaseController
{
    public function index()
    {
        // Instancier le modèle
        $ClientModel = new ClientModel();

        // Récupérer les données de la table `routes`
        $data['clients'] = $ClientModel->findAll();

        // Charger la vue et passer les données
        return view('Customers_view', $data);
    }
    
    public function add()
    {
        if ($this->request->getMethod() === 'POST') {

            $ClientModel = new ClientModel();

            // Récupération des données depuis le formulaire
            $data = [
                'id_client' => $this->request->getPost('id_client'),
                'nom_client' => $this->request->getPost('nom_client'),
                'prenom_client' => $this->request->getPost('prenom_client'),
                'telephone_client' => $this->request->getPost('telephone_client'),
                'email_client' => $this->request->getPost('email_client'),
                'mote_de_passe' => $this->request->getPost('mote_de_passe'),
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Tentative d'insertion dans la base
            if ($ClientModel->insert($data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Route added successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to add route.');
            }

            // Redirection vers /routes
            return redirect()->to('/Customers');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }
    public function update()
    {
        if ($this->request->getMethod() === 'POST') {

            $ClientModel = new ClientModel();

            // Récupérer les données depuis le formulaire
            $id_client = $this->request->getPost('id_client');
            $data = [
                'nom_client' => $this->request->getPost('nom_client'),
                'prenom_client' => $this->request->getPost('prenom_client'),
                'telephone_client' => $this->request->getPost('telephone_client'),
                'email_client' => $this->request->getPost('email_client'),
                'mote_de_passe' => $this->request->getPost('mote_de_passe'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ];

            // Mise à jour de la route
            if ($ClientModel->update($id_client, $data)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Customer updated successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Failed to update Customer.');
            }

            // Redirection vers /routes
            return redirect()->to('/Customers');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }

    public function delete()
    {
        if ($this->request->getMethod() === 'POST') {
            
            $ClientModel = new ClientModel();

            // Récupérer l'ID de la route à supprimer
            $id_client = $this->request->getPost('id_client');

            // Tentative de suppression de la route
            if ($ClientModel->delete($id_client)) {
                // Ajouter un message de succès dans la session flashdata
                session()->setFlashdata('success', 'Customer deleted successfully!');
            } else {
                // Ajouter un message d'erreur dans la session flashdata
                session()->setFlashdata('error', 'Customer to delete route.');
            }

            // Redirection vers /routes
            return redirect()->to('/Customers');
        }

        // Si la méthode n'est pas POST, renvoyer une erreur 405
        return $this->response->setStatusCode(405)->setBody('Method Not Allowed');
    }





}
