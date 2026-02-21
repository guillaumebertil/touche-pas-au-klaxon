<?php

namespace App\Core;

use PDO;
use PDOException;

/**
 * Class Database
 * 
 * Gère la connexion à la base de données
 */
class Database {

    /**
     * L'objet PDO de connexion
     */
    private static ?PDO $instance = null;

    /**
     * Récupère la connexion PDO
     * 
     * Si elle n'existe pas encore, on la crée.
     * Si elle existe déjà, on la retourne.
     * 
     * Utilisation :
     * $pdo = Database::getConnection();
     * $stmt = $pdo->prepare("SELECT * FROM users")
     * 
     * @return PDO
     * @throws PDOException
     */
    public static function getConnection(): PDO {

        // Si la connexion n'existe pas, on la crée
        if (self::$instance === null) {

            // Charger les identifiants de connexion
            require_once __DIR__ . '/../config/database.php';

            try {
                // Créer la connexion PDO
                self::$instance = new PDO(
                    "mysql:host=" . DB_HOST .
                    ";dbname=" . DB_NAME .
                    ";charset=" . DB_CHARSET,
                    DB_USER,
                    DB_PASS
                );

                // Afficher les erreurs SQL
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Format des résultats en tableau associatif
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                // Si la connexion échoue, on arrête tout et on affiche l'erreur
                die("Erreur : " . $e->getMessage());
            }
        }

        // Retourner la connexion
        return self::$instance;
    }
}