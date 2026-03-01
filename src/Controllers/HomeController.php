<?php

namespace App\Controllers;

use App\Core\BaseController;

use App\Models\TripModel;

/**
 * Contrôleur responsable de la gestion de la page d'accueil
 * 
 * @package App\Controllers
 */
class HomeController extends BaseController {

    /**
     * Affiche la page d'accueil
     * 
     * Cette méthode est appelée lorsque l'utilisateur accède à la route "/"
     * Elle charge et affiche la vue correspondante.
     * 
     * @return void
     */
    public function index(): void {
        
        $tripModel = new TripModel();
        $trips = $tripModel->getTrips();
        
        $this->render('home', ['trips' => $trips]);
    }
}