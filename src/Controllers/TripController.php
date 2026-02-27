<?php

namespace App\Controllers;

use App\Core\BaseController;

use App\Models\TripModel;
use App\Models\AgenceModel;

/**
 * Contrôleur des trajets
 * Gère la création, la consultation, la modification et suppression d'un trajet
 * 
 * @package App\Controllers
 */
class TripController extends BaseController{

    /**
     * Affiche le formulaire de création d'un trajet
     * 
     * @return void
     */
    public function showForm(): void {

        $agenceModel = new AgenceModel();
        $agences = $agenceModel->getAgences();

        $view = 'form';
        require __DIR__ . '/../Views/layouts/main.php';
    }

    /**
     * Affiche le formulaire de modification d'un trajet
     * 
     * @return void
     */
    public function showUpdateForm(): void {

        $agenceModel = new AgenceModel();
        $agences = $agenceModel->getAgences();

        $tripModel = new TripModel();

        $trajet_id = (int) $_GET['trajet_id'];
        $trajet = $tripModel->getTrajetById($trajet_id);

        $view = 'updateForm';
        require __DIR__ . '/../Views/layouts/main.php';
    }

    /**
     * Traite le formulaire et crée un trajet
     * 
     * @return void
     */
    public function create(): void {

        $requiredFields = [
            'agence_depart_id',
            'agence_arrivee_id',
            'date_depart',
            'date_arrivee',
            'nb_total_places',
            'nb_total_places_dispo'
        ];

        // Vérifier les champs requis
        if (!$this->checkRequiredFields($requiredFields, $_POST)) {
            $_SESSION['flash-error'] = "Tous les champs sont requis";
            $this->redirect('/form');
        }

        // Vérifier les agences
        if (!$this->isDifferentAgence($_POST['agence_depart_id'], $_POST['agence_arrivee_id'])) {
            $_SESSION['flash-error'] = "L'agence de départ ne peut pas être la même que celle d'arrivée";
            $this->redirect('/form');
        }

        // Vérifier les dates
        if (!$this->isValidOrder($_POST['date_depart'], $_POST['date_arrivee'])) {
            $_SESSION['flash-error'] = "La date d'arrivée doit être postérieure à la date de départ";
            $this->redirect('/form');
        }

        // Vérifier les places
        if (!$this->hasSufficientSeats($_POST['nb_total_places'], $_POST['nb_total_places_dispo'])) {
            $_SESSION['flash-error'] = "Le nombre de place disponible doit être au moins 1 et inférieur au nombre total de places";
            $this->redirect('/form');
        }

        // Récupération des données
        $user_id                = $_SESSION['user_id'];
        $agence_depart_id       = $_POST['agence_depart_id'];
        $agence_arrivee_id      = $_POST['agence_arrivee_id'];
        $date_depart            = $_POST['date_depart'];
        $date_arrivee           = $_POST['date_arrivee'];
        $nb_total_places        = $_POST['nb_total_places'];
        $nb_total_places_dispo  = $_POST['nb_total_places_dispo'];

        $trip = new TripModel();

        $createdTrip = $trip->createTrip(
            $user_id,
            $agence_depart_id,
            $agence_arrivee_id,
            $date_depart,
            $date_arrivee,
            $nb_total_places,
            $nb_total_places_dispo
        );

        if(!$createdTrip) {
            $_SESSION['flash-error'] = "Echec lors de la création du trajet";
            $this->redirect('/form');
        }

        $_SESSION['flash-success'] = "Trajet créé avec succès";
        $this->redirect('/');
    }

    /**
     * Modifie un trajet
     * 
     * @return void
     */
    public function update(): void {

        $trajet_id = $_POST['trajet_id'];

        $requiredFields = [
            'agence_depart_id',
            'agence_arrivee_id',
            'date_depart',
            'date_arrivee',
            'nb_total_places',
            'nb_total_places_dispo'
        ];

        // Vérifier les champs requis
        if (!$this->checkRequiredFields($requiredFields, $_POST)) {
            $_SESSION['flash-error'] = "Tous les champs sont requis";
            $this->redirect('/updateForm?trajet_id=' . $trajet_id);
        }

        // Vérifier les agences
        if (!$this->isDifferentAgence($_POST['agence_depart_id'], $_POST['agence_arrivee_id'])) {
            $_SESSION['flash-error'] = "L'agence de départ ne peut pas être la même que celle d'arrivée";
            $this->redirect('/updateForm?trajet_id=' . $trajet_id);
        }

        // Vérifier les dates
        if (!$this->isValidOrder($_POST['date_depart'], $_POST['date_arrivee'])) {
            $_SESSION['flash-error'] = "La date d'arrivée doit être postérieure à la date de départ";
            $this->redirect('/updateForm?trajet_id=' . $trajet_id);
        }

        // Vérifier les places
        if (!$this->hasSufficientSeats($_POST['nb_total_places'], $_POST['nb_total_places_dispo'])) {
            $_SESSION['flash-error'] = "Le nombre de place disponible doit être au moins 1 et inférieur au nombre total de places";
            $this->redirect('/updateForm?trajet_id=' . $trajet_id);
        }

        // Récupération des données
        $agence_depart_id       = $_POST['agence_depart_id'];
        $agence_arrivee_id      = $_POST['agence_arrivee_id'];
        $date_depart            = $_POST['date_depart'];
        $date_arrivee           = $_POST['date_arrivee'];
        $nb_total_places        = $_POST['nb_total_places'];
        $nb_total_places_dispo  = $_POST['nb_total_places_dispo'];

        $trip = new TripModel();

        $updateTrip = $trip->updateTrip(
            $agence_depart_id,
            $agence_arrivee_id,
            $date_depart,
            $date_arrivee,
            $nb_total_places,
            $nb_total_places_dispo,
            $trajet_id
        );

        if(!$updateTrip) {
            $_SESSION['flash-error'] = "Echec lors de la modification du trajet";
            $this->redirect('/updateForm?trajet_id=' . $trajet_id);
        }

        $_SESSION['flash-success'] = "Trajet modifié avec succès";
        $this->redirect('/');
    }

    /**
     * Supprime un trajet
     * 
     * @return void
     */
    public function delete(): void {

        // Récupération des données
        $trajet_id = $_POST['trajet_id'];

        $trip = new TripModel();
        $deleteTrip = $trip->deleteTrip($trajet_id);

        if(!$deleteTrip) {
            $_SESSION['flash-error'] = "Echec lors de la suppression du trajet";
            $this->redirect('/');
        } else {
            $_SESSION['flash-success'] = "Trajet supprimé avec succès";
            $this->redirect('/');
        }
    }

    /**
     * Vérifie que l'agence de départ est différente de celle d'arrivée
     * 
     * @param string $agence_depart Agence de départ
     * @param string $agence_arrivee Agence d'arrivée
     * 
     * @return bool true si différent, false sinon
     */
    private function isDifferentAgence(string $agence_depart, string $agence_arrivee): bool {
        return $agence_depart !== $agence_arrivee;
    }

    /**
     * Vérifie que la date d'arrivée est après la date de départ
     * 
     * @param string $date_depart Date de départ
     * @param string $date_arrivee Date d'arrivée
     * 
     * @return bool true si la date d'arrivée est après celle de départ, false sinon
     */
    private function isValidOrder(string $date_depart, string $date_arrivee): bool {
        return strtotime($date_depart) < strtotime($date_arrivee);
    }
}