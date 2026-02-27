<?php

namespace App\Models;

use App\Core\Database;

use PDO;

/**
 * Model User
 * 
 * Gère toutes les interactions avec la table users
 * 
 * @package App\Models
 */
class UserModel {

    private PDO $pdo;

    /**
     * Constructeur : récupére la connexion PDO
     * 
     * @return void
     */
    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Récupère la liste des utilisateurs
     * 
     * @return array Liste des utilisateurs
     * @throws \PDOException
     */
    public function getAllUsers(): array {
        $sql = "SELECT nom, prenom, telephone, email
                FROM users";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Récupère un utilisateur par son email
     * 
     * @param string $email Email de l'utilisateur
     * @return array|false Données de l'utilisateur ou false
     */
    public function findByEmail(string $email): array|false {
        $sql = "SELECT *
                FROM users
                WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch();
    }
}