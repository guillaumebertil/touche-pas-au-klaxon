<?php

namespace App\Controllers;

/**
 * Contrôleur responsable de la gestion de la page d'accueil
 * 
 * @package App\Controllers
 */
class HomeController {

    /**
     * Affiche la page d'accueil
     * 
     * Cette méthode est appelée lorsque l'utilisateur accède à la route "/"
     * Elle charge et affiche la vue correspondante.
     * 
     * @return void
     */
    public function index(): void {
        require __DIR__ . '/../Views/home.php';
    }
}