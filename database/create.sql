-- ======================================
-- BASE DE DONNEES "TOUCHE PAS AU KLAXON"
-- ======================================


-- ======================================
-- CREATION DE LA BASE DE DONNEES
-- ======================================

-- Supprime la base de données si existante
DROP DATABASE IF EXISTS touche_pas_au_klaxon;

-- Créé la base
CREATE DATABASE touche_pas_au_klaxon
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Utiliser la base qui vient d'être créée
USE touche_pas_au_klaxon;


-- ======================================
-- CREATION DES TABLES
-- ======================================


-- ======================================
-- TABLE DES ROLES
-- ======================================

-- Supprime la table si existante
DROP TABLE IF EXISTS roles;

-- Créé la table si existante
CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL UNIQUE,
    description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ======================================
-- TABLE DES USERS
-- ======================================

-- Supprime la table si existante
DROP TABLE IF EXISTS users;

-- Créé la base
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Clés étrangères
    FOREIGN KEY (role_id) REFERENCES roles(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ======================================
-- TABLE DES AGENCES
-- ======================================

-- Supprime la table si existante
DROP TABLE IF EXISTS agences;

-- Créé la base
CREATE TABLE agences (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ville VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ======================================
-- TABLE DES TRAJETS
-- ======================================

-- Supprime la table si existante
DROP TABLE IF EXISTS trajets;

-- Créé la base
CREATE TABLE trajets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    agence_depart_id INT NOT NULL,
    agence_arrivee_id INT NOT NULL,
    date_depart DATETIME NOT NULL,
    date_arrivee DATETIME NOT NULL,
    nb_total_places TINYINT UNSIGNED NOT NULL,
    nb_total_places_dispo TINYINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    -- Clés étrangères
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (agence_depart_id) REFERENCES agences(id),
    FOREIGN KEY (agence_arrivee_id) REFERENCES agences(id),

    -- Contraintes
    -- L'agence de départ est différéntes de l'agence d'arrivée
    CHECK (agence_depart_id != agence_arrivee_id),
    -- La date d'arrivée est après la date de départ
    CHECK (date_depart < date_arrivee),
    -- Le nombre de places disponibles ne dépasse pas le nombre de places
    CHECK (nb_total_places_dispo <= nb_total_places),
    -- Le nombre de places disponible est supérieur à 0
    CHECK (nb_total_places_dispo >= 0)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;