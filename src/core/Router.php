<?php

namespace App\Core;

// Import des contrôllers
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\TripController;
use App\Controllers\AdminController;

/**
 * Classe Router
 * 
 * Gère les routes
 * 
 * @package App\Core
 */
class Router {

    private $router;

    public function __construct() {
        $this->router = new \Bramus\Router\Router();
    }

    public function register() {

        // Page d'accueil "/"
        $this->router->get('/', function() {
            $controller = new HomeController();
            $controller->index();
        });

        // Page d'authentification
        $this->router->get('/auth', function() {
            $controller = new AuthController();
            $controller->index();
        });

        // Traite la connexion
        $this->router->post('/auth', function() {
            $controller = new AuthController();
            $controller->login();
        });

        // Traite la déconnexion
        $this->router->get('/logout', function() {
            $controller = new AuthController();
            $controller->logout();
        });

        // Affiche le formulaire de création de trajet
        $this->router->get('/form', function() {
            $controller = new TripController();
            $controller->showForm();
        });

        // Traite le formulaire de création de trajet
        $this->router->post('/form', function() {
            $controller = new TripController();
            $controller->create();
        });

        // Affiche le formulaire de modification de trajet
        $this->router->get('/updateForm', function() {
            $controller = new TripController();
            $controller->showUpdateForm();
        });

        // Traite le formulaire de modification de trajet
        $this->router->post('/updateForm', function() {
            $controller = new TripController();
            $controller->update();
        });

        // Traite la suppression de trajet
        $this->router->post('/delete', function() {
            $controller = new TripController();
            $controller->delete();
        });

        // Affiche le dashboard
        $this->router->get('/dashboard', function() {
            $controller = new AdminController();
            $controller->dashboard();
        });

        // Affiche la liste des utilisateurs
        $this->router->get('/dashboard/users', function() {
            $controller = new AdminController();
            $controller->showUsers();
        });

        // Affiche la liste des agences
        $this->router->get('/dashboard/agences', function() {
            $controller = new AdminController();
            $controller->showAgences();
        });

        // Traite le formulaire de création d'agence
        $this->router->post('/dashboard/agences', function() {
            $controller = new AdminController();
            $controller->createAgence();
        });

        // Traite le formulaire de modification d'agence
        $this->router->post('/dashboard/updateAgences', function() {
            $controller = new AdminController();
            $controller->updateAgence();
        });

        // Traite la suppression d'agence
        $this->router->post('/dashboard/deleteAgences', function() {
            $controller = new AdminController();
            $controller->deleteAgence();
        });

        // Affiche la liste des trajets
        $this->router->get('/dashboard/trajets', function() {
            $controller = new AdminController();
            $controller->showTrajets();
        });

        // Traite la suppresion de trajet
        $this->router->post('/dashboard/deleteTrajets', function() {
            $controller = new AdminController();
            $controller->deleteTrip();
        });

        // ======================
        // Gestion des erreurs
        // ======================

        // Route exécutée si aucune URL ne correspond (erreur 404)
        $this->router->set404(function() {
            header('HTTP/1.1 404 Not Found');
            echo "<h1>Page introuvable</h1>";
        });
    }

    public function run() {
        $this->router->run();
    }
}