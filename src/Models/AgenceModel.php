<?php 

namespace App\Models;

use App\Core\Database;

use PDO;

/**
 * Model Agence
 * 
 * Gère les interactions avec la table agences
 * 
 * @package App\Model
 */
class AgenceModel {

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
     * Récupère la liste des agences
     * 
     * @return array|false
     * @throws \PDOException
     */
    public function getAgences(): array|false {
        $sql = "SELECT *
                FROM agences
                ORDER BY ville ASC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}