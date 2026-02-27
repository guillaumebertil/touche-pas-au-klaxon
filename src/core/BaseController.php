<?php

namespace App\Core;

/**
 * Classe BaseController
 */
class BaseController{

    /**
     * Vérifie que tous les champs requis sont présents et non vides
     * 
     * @param array $fields Tableau contenant les champs à vérifier
     * @param array $data Données à vérifier (ex: $_POST)
     * 
     * @return bool true si tous les champs sont remplis, false sinon
     */
    protected function checkRequiredFields(array $fields, array $data): bool {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }
        return true;
    }    

    /**
     * Rediriger vers une URL
     * 
     * @param string $path URL de redirection
     * @return void
     */
    protected function redirect(string $path): void {
        header('Location: ' . BASE_URL . $path);
        exit;
    }
}