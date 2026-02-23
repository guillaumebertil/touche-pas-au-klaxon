<?php

namespace App\Models;

use App\Core\Database;

use PDO;

/**
 * Model Trajet
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
                       date_depart, date_arrivee, nb_total_places_dispo
                FROM trajets
                JOIN agences AS agences_depart ON trajets.agence_depart_id = agences_depart.id
                JOIN agences AS agences_arrivee ON trajets.agence_arrivee_id = agences_arrivee.id
                WHERE date_depart > NOW() AND nb_total_places_dispo > 0
                ORDER BY date_depart ASC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}