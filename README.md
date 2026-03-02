# TOUCHE PAS AU KLAXON

## Description

Touche pas au klaxon est une application de co-voiturage intranet.

### Un utilisateur non-connecté peut:
- voir les trajets disponibles

### Un utilisateur connecté peut:
- obtenir plus de détails sur un trajet (informations sur la personne à contacter)
- proposer un trajet
- modifier et supprimer un trajet

### L'administrateur peut:
- accéder au tableau de bord
- avoir la liste des utilisateurs
- avoir la liste des agences
- avoir la liste des trajets
- créer, modifier ou supprimer une agence
- supprimer un trajet

## Installation

### Stack technique

- PHP 8.2.12
- Architecture MVC
- Base de données MySQL / MariaDB
- Routeur Bramus Router
- CSS Bootstrap 5 + SCSS
- Gestion des dépendances Composer + npm

### Pré-requis

- PHP >= 8.2
- MySQL ou MariaDB
- Composer
- Node.js + npm
- Un serveur web

### 1. Cloner le dépôt

```
git clone https://github.com/guillaumebertil/touche-pas-au-klaxon.git
cd touche-pas-au-klaxon
```

### 2. Installer les dépendances PHP

```
composer install
```

### 3. Installer les dépendances CSS

```
npm install
```

### 4. Configurer la base de données

Copier le fichier de configuration et renseigner vos identifiants

```
cp src/config/database.example.php src/config/database.php
```

Modifier src/config/database.php
```
define('DB_HOST', 'localhost');
define('DB_NAME', 'touche_pas_au_klaxon');
define('DB_USER', 'votre_utilisateur');
define('DB_PASS', 'votre_mot_de_passe');
define('DB_CHARSET', 'utf8mb4');
```

### 5. Créer et alimenter la base de données

```
-- Créer la base de données
source database/create.sql

-- Insérer les données de test
source database/seed.sql
```

### 6. Compiler le SCSS

```
sass src/scss/main.scss public/assets/css/main.css
```

### 7. Configurer le chemin de base

Dans public/index.php, modifier la constante BASE_URL selon votre configuration

```
define('BASE_URL', '/touche-pas-au-klaxon')
```

## Utilisation

Accéder à l'application via votre navigateur

```
http://localhost/touche-pas-au-klaxon/public
```

## Comptes de test

### Administrateur
- email: admin@example.com
- mot de passe: password123

### Utilisateur
- email: alexandre.martin@email.fr
- mot de passe: password123