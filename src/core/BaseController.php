<?php

namespace App\Core;

/**
 * Classe BaseController
 */
class BaseController
{
    /**
     * Affichage les vues
     * 
     * @param string $view Vue à générer
     * @param array $data Données à passer à la vue
     * 
     * @return void
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../Views/layouts/main.php';
    }

    /**
     * Rediriger vers une URL
     * 
     * @param string $path URL de redirection
     * @return void
     */
    protected function redirect(string $path): void
    {
        header('Location: ' . BASE_URL . $path);
        exit;
    }

    /**
     * Vérifie que tous les champs requis sont présents et non vides
     * 
     * @param array $fields Tableau contenant les champs à vérifier
     * @param array $data Données à vérifier (ex: $_POST)
     * 
     * @return bool true si tous les champs sont remplis, false sinon
     */
    protected function checkRequiredFields(array $fields, array $data): bool
    {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }
        return true;
    }
    
    /** Vérifie si l'utilisateur est connecté
     * 
     * @return bool true si l'utilisateur est connecté, false sinon
     */
    protected function isLogged(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Vérifie si l'utilisateur est l'administrateur ou non
     * 
     * @return bool true si l'utilisateur est administrateur, false sinon
     */
    protected function isAdmin(): bool
    {
        return isset($_SESSION['role_id']) && $_SESSION['role_id'] === 2;
    }

    /**
     * Vérifie que l'utilisateur est connecté
     * 
     * Redirige vers la page de connexion s'il n'est pas connecté
     * 
     * @return void
     */
    protected function requireLogged(): void
    {
        if (!$this->isLogged()) {
            $_SESSION['flash-error'] = "Vous devez être connecté pour accéder à cette page";
            $this->redirect('/auth');
        }
    }

    /**
     * Vérifie que l'utilisateur est connecté et possède le rôle administrateur
     * 
     * Redirige vers la page de connexion s'il n'est pas connecté
     * Redirige vers l'accueil s'il n'est pas administrateur
     * Affiche un message d'erreur
     * 
     * @return void
     */
    protected function requireAdmin(): void
    {
        $this->requireLogged();

        if(!$this->isAdmin()) {
            $_SESSION['flash-error'] = "Vous n'avez pas accès à cette page";
            $this->redirect('/');
        }
    }
}