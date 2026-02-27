<?php

// Démarre la session
session_start();

// Charge l'autoloader de Composer pour gérer automatiquement les classes
require __DIR__ . '/../vendor/autoload.php';

// Définit le chemin absolu
define('BASE_URL', '/touche-pas-au-klaxon/public');

use App\Core\Router;

$router = new Router;
$router->register();

$router->run();