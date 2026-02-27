<?php 

namespace App\Controllers;

use App\Core\BaseController;

use App\Models\UserModel;

/**
 * Contrôleur responsable de la gestion de la page de connexion
 * 
 * @package App\Controllers
 */
class AuthController extends BaseController{

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

        $requiredFields = [
            'email',
            'password'
        ];

        // Vérifier que les champs email et mot de passe sont remplis
        if(!$this->checkRequiredFields($requiredFields, $_POST)) {
            $_SESSION['flash-error'] = "Tous les champs sont requis";
            $this->redirect('/auth');
        }

        // Créer une instance
        $userModel = new UserModel();
        $userData = $userModel->findByEmail($_POST['email']);

        if(!$userData) {
            $_SESSION['flash-error'] = "Email ou mot de passe incorrect";
            $this->redirect('/auth');
        }

        // Vérifier le mot de passe
        $passwordCheck = password_verify($_POST['password'], $userData['password']);

        if(!$passwordCheck) {
            $_SESSION['flash-error'] = "Email ou mot de passe incorrect";
            $this->redirect('/auth');
        }

        // Stocker les données dans la session
        $_SESSION['nom']     = $userData['nom'];
        $_SESSION['prenom']  = $userData['prenom'];
        $_SESSION['role_id'] = $userData['role_id'];
        $_SESSION['user_id'] = $userData['id'];

        $_SESSION['flash-success'] = "Connexion réussie";
        $this->redirect('/');
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

        $_SESSION['flash-success'] = "Vous avez été déconnecté avec succès";
        $this->redirect('/');
    }
}