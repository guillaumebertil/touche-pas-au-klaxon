-- ======================================
-- BASE DE DONNEES "TOUCHE PAS AU KLAXON"
-- ======================================


-- ======================================
-- INSERTION DE DONNEES
-- ======================================


-- ======================================
-- TABLE DES ROLES
-- ======================================

INSERT INTO roles (id, name, description) VALUES
(1, 'user', 'Utilisateur'),
(2, 'admin', 'Administrateur');


-- ======================================
-- TABLE DES AGENCES
-- ======================================

INSERT INTO agences (ville) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');


-- ======================================
-- TABLE DES USERS
-- ======================================

INSERT INTO users (nom, prenom, telephone, email, password, role_id) VALUES
('Admin', 'Super', '0600000001', 'admin@example.com', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 2),
('Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Fontaine', 'Louis','0655667788', 'louis.fontaine@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Masson', 'Julie', '0733445566', 'julie.masson@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1),
('Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', '$2y$12$BlZhql7Zl1uw35V4SIbhOu1HixeAhOBgFQ5UiTjV1pJ3xrIJAEJZa', 1);


-- ======================================
-- TABLE DES TRAJETS
-- ======================================
INSERT INTO trajets (user_id, agence_depart_id, agence_arrivee_id, date_depart, date_arrivee, nb_total_places, nb_total_places_dispo) VALUES
-- Auteur : Martin Alexandre
-- Agence de départ : Paris
-- Agence d'arrivée : Lyon
-- Date de départ : 23/02/2026 à 08h00
-- Date d'arrivée : 23/02/2026 à 14h00
-- Nombre total de places : 5
-- Nombre total de places disponibles : 4
(2, 1, 2, '2026-03-23 08:00:00', '2026-03-23 14:00:00', 5, 4),

-- Auteur : Dubois Sophie
-- Agence de départ : Lyon
-- Agence d'arrivée : Nice
-- Date de départ : 15/03/2026 à 09h00
-- Date d'arrivée : 15/03/2026 à 15h00
-- Nombre total de places : 4
-- Nombre total de places disponibles : 2
(3, 2, 5, '2026-03-15 09:00:00', '2026-03-15 15:00:00', 4, 2),

-- Trajet complet (ne doit pas apparaître)
-- Auteur : Bernard Julien
-- Agence de départ : Nice
-- Agence d'arrivée : Paris
-- Date de départ : 20/03/2026 à 10h00
-- Date d'arrivée : 20/03/2026 à 16h00
-- Nombre total de places : 4
-- Nombre total de places disponibles : 0
(4, 3, 1, '2026-03-20 10:00:00', '2026-03-20 16:00:00', 4, 0),

-- Trajet passé (ne doit pas apparaître)
-- Auteur : Moreau Camille
-- Agence de départ : Toulouse
-- Agence d'arrivée : Nantes
-- Date de départ : 10/01/2026 à 08h00
-- Date d'arrivée : 10/01/2026 à 12h00
-- Nombre total de places : 5
-- Nombre total de places disponibles : 3
(5, 4, 6, '2026-01-10 08:00:00', '2026-01-10 12:00:00', 5, 3);

