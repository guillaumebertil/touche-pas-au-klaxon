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
     * Créer une nouvelle agence
     * 
     * @param string $ville Nom de la ville
     * 
     * @return bool True si la création réussie, false sinon
     */
    public function createAgence(string $ville): bool {
        $sql = "INSERT INTO agences (ville)
                VALUES (:ville)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':ville' => $ville
        ]);
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

    /**
     * Modifie une agence
     * 
     * @param string $ville Nom de la ville
     * @param int $agence_id ID de l'agence
     * 
     * @return bool True si la modification réussie, false sinon
     */
    public function updateAgence(string $ville, int $agence_id): bool {
        $sql = "UPDATE agences
                SET ville = :ville
                WHERE agences.id = :agence_id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':ville'     => $ville,
            ':agence_id' => $agence_id
        ]);
    }

    /**
     * Supprime une agence
     * 
     * @param int $agence_id ID de l'agence
     * 
     * @return bool True si la suppression réussie, false sinon
     */
    public function deleteAgence(int $agence_id): bool {
        $sql = "DELETE FROM agences
                WHERE agences.id = :agences_id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':agences_id' => $agence_id
        ]);
    }
}