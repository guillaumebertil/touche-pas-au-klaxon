<?php 

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Contrôleur responsable de la gestion de la page de connexion
 * 
 * @package App\Controllers
 */
class AuthController {

    /**
     * Affiche la page de connexion
     * 
     * Cette méthode est appelée lorsque l'utilisateur accède à la route "connexion"
     * Elle charge et affiche la vue correspondante
     * 
     * @return void
     */
    public function index(): void {
        $view = 'auth';
        require __DIR__ . '/../Views/layouts/main.php';
    }

    /**
     * Traite la connexion
     * 
     * Cette méthode est appelée lorsque l'utlisateur se connecte via le formulaire de connexion
     * 
     * @return void
     */
    public function login(): void {

        if (!empty($_POST['email']) && !empty($_POST['password'])) {

        // Créer une instance du modèle
        $userModel = new UserModel();

        $userData = $userModel->findByEmail($_POST['email']);

        if ($userData) {

            // Vérifier le mot de passe
            $passwordCheck = password_verify($_POST['password'], $userData['password']);

            if ($passwordCheck) {
                // Stocker les données dans la session
                $_SESSION['nom']     = $userData['nom'];
                $_SESSION['prenom']  = $userData['prenom'];
                $_SESSION['role_id'] = $userData['role_id'];
                $_SESSION['user_id'] = $userData['id'];

                // Affiche un message flash
                $_SESSION['flash-success'] = "Connexion réussie";

                // Rédiriger vers la page d'accueil
                header('Location: ' . BASE_URL . '/');
                exit;

            } else {
                // Afficher un message flash
                $_SESSION['flash-error'] = "Email ou mot de passe incorrecte";

                // Rediriger vers la page de connexion
                header('Location: ' . BASE_URL . '/auth');
                exit;
            }

        } else {
            // Afficher un message flash
            $_SESSION['flash-error'] = "Email ou mot de passe incorrecte";

            // Rediriger vers la page de connexion
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
            
        } else {
            // Afficher un message flash
            $_SESSION['flash-error'] = "Les 2 champs sont obligatoires";

            // Rediriger vers la page de connexion
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }

    /**
     * Traite la déconnexion
     * 
     * Cette méthode est appelée lorsque l'utlisateur se déconnecte via le bouton de déconnexion
     * 
     * @return void
     */
    public function logout(): void {

        // Détruire toutes les variables de session
        session_unset();

        // Détruire la session
        session_destroy();

        // Redémarrer une nouvelle session
        session_start();

        // Afficher un message flash
        $_SESSION['flash-success'] = "Vous avez été déconecté avec succès";

        // Redirige vers l'accueil
        header('Location: ' . BASE_URL . '/');
        exit;
    }
}