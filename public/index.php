<?php

// Démarre la session
session_start();

// Charge l'autoloader de Composer pour gérer automatiquement les classes
require __DIR__ . '/../vendor/autoload.php';

// Définit le chemin absolu
define('BASE_URL', '/touche-pas-au-klaxon/public');

// Import des contrôllers
use App\Controllers\HomeController;
use App\Controllers\AuthController;

// Création d'une instance du routeur (Bramus Router)
$router = new \Bramus\Router\Router();

// ======================
// Définition des routes
// ======================

// Page d'accueil "/"
$router->get('/', function() {
    $controller = new HomeController();
    $controller->index();
});

// Page d'authentification
$router->get('/auth', function() {
    $controller = new AuthController();
    $controller->index();
});

// Traite la connexion
$router->post('/auth', function() {
    $controller = new AuthController();
    $controller->login();
});

// ======================
// Gestion des erreurs
// ======================

// Route exécutée si aucune URL ne correspond (erreur 404)
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo "<h1>Page introuvable</h1>";
});

// ======================
// Lancement du routeur
// ======================
$router->run();