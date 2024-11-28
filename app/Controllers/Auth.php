<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\AdminModel;

class Auth extends BaseController
{
    public function registerView()
    {
        return view('register_view');
    }

    public function register()
    {
    $validation = \Config\Services::validation();

    $rules = [
        'nom_client'       => 'required|min_length[3]|max_length[50]',
        'prenom_client'    => 'required|min_length[3]|max_length[50]',
        'email_client'     => 'required|valid_email|is_unique[clients.email_client]',
        'telephone_client' => 'required|min_length[10]|max_length[15]',
        'mot_de_passe'     => 'required|min_length[6]',
        'confirm_password' => 'required|matches[mot_de_passe]',
        // 'agree_terms'      => 'required',
    ];

    if (!$this->validate($rules)) {
        // Storing validation errors in session
        return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
    }

    // Insert data into the model
    $clientModel = new ClientModel();
    $data = [
        'nom_client'       => $this->request->getPost('nom_client'),
        'prenom_client'    => $this->request->getPost('prenom_client'),
        'email_client'     => $this->request->getPost('email_client'),
        'telephone_client' => $this->request->getPost('telephone_client'),
        'mot_de_passe'     => password_hash($this->request->getPost('mot_de_passe'), PASSWORD_DEFAULT),
    ];

    if ($clientModel->insert($data)) {
        return redirect()->to(site_url('auth/login'))->with('success', 'Registration successful.');
    }

    return redirect()->back()->withInput()->with('error', 'Failed to register. Please try again.');
    }

    public function loginView()
    {
        return view('login_view');
    }

    public function login()
    {
        helper(['form', 'url']); // Charger les helpers nécessaires
        
        if ($this->request->getMethod() === 'POST') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $adminModel = new AdminModel();
            $clientModel = new ClientModel();

            // Vérification de l'utilisateur dans la table admin
            $admin = $adminModel->where('email_admin', $email)->first();

            if ($admin) {
                if (password_verify($password, $admin['mot_de_passe'])) {
                    // Stocker les données de l'administrateur dans la session
                    session()->set([
                        'id' => $admin['id_admin'],
                        'email' => $admin['email_admin'],
                        'role' => 'admin',
                        'isLoggedIn' => true,
                    ]);

                    return redirect()->to('/dashboard'); // Redirection vers le tableau de bord
                } else {
                    return redirect()->back()->with('error', 'Mot de passe incorrect.');
                }
            }

            // Vérification de l'utilisateur dans la table clients
            $client = $clientModel->where('email_client', $email)->first();

            if ($client) {
                if (password_verify($password, $client['mot_de_passe'])) {
                    // Stocker les données du client dans la session
                    session()->set([
                        'id' => $client['id_client'],
                        'email' => $client['email_client'],
                        'role' => 'client',
                        'isLoggedIn' => true,
                    ]);

                    return redirect()->to('/home'); // Redirection vers la page d'accueil
                } else {
                    return redirect()->back()->with('error', 'Mot de passe incorrect.');
                }
            }

            // Aucun utilisateur trouvé
            return redirect()->back()->with('error', "L'email n'existe pas.");
        }

        // Charger la vue de connexion si ce n'est pas une requête POST
        return view('login_view');
    }
}