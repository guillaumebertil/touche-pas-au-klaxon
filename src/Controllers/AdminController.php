<?php

namespace App\Controllers;

use App\Core\BaseController;

use App\Models\AgenceModel;
use App\Models\TripModel;
use App\Models\UserModel;

/**
 * Contrôleur de l'administrateur
 * 
 * @package App\Controllers
 */
class AdminController extends BaseController{

    /**
     * Affiche le tableau de bord
     * 
     * @return void
     */
    public function dashboard(): void {
        $this->render('dashboard');
    }

    /**
     * Affiche la liste des utilisateurs
     * 
     * @return void
     */
    public function showUsers():void {

        $usersModel = new UserModel();
        $users = $usersModel->getAllUsers();

        $this->render('dashboard/users', ['users' => $users]);
    }

    /**
     * Affiche la liste des agences
     * 
     * @return void
     */
    public function showAgences():void {

        $agenceModel = new AgenceModel();
        $agences = $agenceModel->getAgences();

        $this->render('dashboard/agences', ['agences' => $agences]);
    }

    /**
     * Affiche la liste des trajets
     * 
     * @return void
     */
    public function showTrajets():void {

        $trajetsModel = new TripModel();
        $trips = $trajetsModel->getAllTrips();

        $this->render('dashboard/trajets', ['trips' => $trips]);
    }

    /**
     * Créer une agence
     * 
     * @return void
     */
    public function createAgence(): void {

        $requiredFields = [
            'ville'
        ];

        if (!$this->checkRequiredFields($requiredFields, $_POST)) {
            $_SESSION['flash-error'] = "Tous les champs sont requis";
            $this->redirect('/dashboard');
        }

        // Récupération des données
        $ville = $_POST['ville'];

        $agence = new AgenceModel();

        $createdAgence = $agence->createAgence($ville);

        if(!$createdAgence) {
            $_SESSION['flash-error'] = "Erreur lors de la création de l'agence";
            $this->redirect('/dashboard/agences');
        }

        $_SESSION['flash-success'] = "Agence créé avec succès";
        $this->redirect('/dashboard/agences');
    }

    /**
     * Modifie une agence
     * 
     * @return void
     */
    public function updateAgence(): void {

        $requiredFields = [
            'ville'
        ];

        if (!$this->checkRequiredFields($requiredFields, $_POST)) {
            $_SESSION['flash-error'] = "Tous les champs sont requis";
            $this->redirect('/dashboard');
        }

        $ville = $_POST['ville'];
        $agence_id = $_POST['agence_id'];

        $agence = new AgenceModel();

        $updatedAgence = $agence->updateAgence($ville, $agence_id);

        if(!$updatedAgence) {
            $_SESSION['flash-error'] = "Erreur lors de la modification de l'agence";
            $this->redirect('/dashboard/agences');
        }

        $_SESSION['flash-success'] = "Agence modifiée avec succès";
        $this->redirect('/dashboard/agences');
    }

    /**
     * Supprime une agence
     * 
     * @return void
     */
    public function deleteAgence(): void {

        $requiredFields = [
            'agence_id'
        ];

        if (!$this->checkRequiredFields($requiredFields, $_POST)) {
            $_SESSION['flash-error'] = "Tous les champs sont requis";
            $this->redirect('/dashboard');
        }

        // Récupération des données
        $agence_id = (int) $_POST['agence_id'];

        $agence = new AgenceModel();
        $deleteAgence = $agence->deleteAgence($agence_id);

        if(!$deleteAgence) {
            $_SESSION['flash-error'] = "Echec lors de la suppression de l'agence";
            $this->redirect('/dashboard/agences');
        } else {
            $_SESSION['flash-success'] = "Agence supprimée avec succès";
            $this->redirect('/dashboard/agences');
        }
    }

    /**
     * Supprime un trajet
     * 
     * @return void
     */
    public function deleteTrip(): void {

        $requiredFields = [
            'trajet_id'
        ];

        if (!$this->checkRequiredFields($requiredFields, $_POST)) {
            $_SESSION['flash-error'] = "Tous les champs sont requis";
            $this->redirect('/dashboard');
        }

        // Récupération des données
        $trajet_id = (int) $_POST['trajet_id'];

        $trip = new TripModel();
        $deleteTrip = $trip->deleteTrip($trajet_id);

        if(!$deleteTrip) {
            $_SESSION['flash-error'] = "Echec lors de la suppression du trajet";
            $this->redirect('/dashboard/trajets');
        } else {
            $_SESSION['flash-success'] = "Trajet supprimé avec succès";
            $this->redirect('/dashboard/trajets');
        }
    }
}