<?php

namespace App\Models;

use App\Core\Database;

use PDO;

/**
 * Model Trajets
 * 
 * Gère toutes les interaction avec la table trajet
 * 
 * @package App\Model
 */
class TripModel {

    private PDO $pdo;

    /**
     * Constructeur : récupère la connexion PDO
     * 
     * @return void
     */
    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Récupérer la liste des trajets disponible
     * 
     * @return array|false
     * @throws \PDOException
     */
    public function getTrips(): array|false {
            $sql = "SELECT agences_depart.ville AS ville_depart,
                       agences_arrivee.ville AS ville_arrivee,
                       trajets.id AS trajet_id,
                       date_depart, date_arrivee, nb_total_places_dispo, nb_total_places,
                       user_id,
                       users.nom AS user_nom,
                       users.prenom AS user_prenom,
                       users.telephone AS user_telephone,
                       users.email AS user_email
                FROM trajets
                JOIN agences AS agences_depart ON trajets.agence_depart_id = agences_depart.id
                JOIN agences AS agences_arrivee ON trajets.agence_arrivee_id = agences_arrivee.id
                JOIN users ON trajets.user_id = users.id
                WHERE date_depart > NOW() AND nb_total_places_dispo > 0
                ORDER BY date_depart ASC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    /**
     * Créer un nouveau trajet
     * 
     * @param int $user_id ID de l'utilisateur
     * @param int $agence_depart_id ID de l'agence de départ
     * @param int $agence_arrive_id ID de l'agence d'arrivée
     * @param string $date_depart Date de départ
     * @param string $date_arrivee Date d'arrivée
     * @param int $nb_total_places Nombre total de place
     * @param int $nb_total_places_dispo Nombre total de places disponibles
     * 
     * @return bool True si la création réussie, false sinon
     */
    public function createTrip(int $user_id, int $agence_depart_id, int $agence_arrive_id, string $date_depart, string $date_arrivee, int $nb_total_places, int $nb_total_places_dispo): bool {
        $sql = "INSERT INTO trajets (user_id, agence_depart_id, agence_arrivee_id, date_depart, date_arrivee, nb_total_places, nb_total_places_dispo)
                VALUES (:user_id, :agence_depart_id, :agence_arrivee_id, :date_depart, :date_arrivee, :nb_total_places, :nb_total_places_dispo)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':user_id'                  => $user_id,
            ':agence_depart_id'         => $agence_depart_id,
            ':agence_arrivee_id'        => $agence_arrive_id,
            ':date_depart'              => $date_depart,
            ':date_arrivee'             => $date_arrivee,
            ':nb_total_places'          => $nb_total_places,
            ':nb_total_places_dispo'    => $nb_total_places_dispo
        ]);
    }
}