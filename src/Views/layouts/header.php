<header>
    <!-- Navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary px-5" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>">Touche pas au klaxon</a>
            
            <!-- Connexion/déconnexion -->
            <div class="d-flex">
                <ul class="navbar-nav mr-auto">

                    <!-- Utilisateur connecté -->
                    <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1): ?>
                        <!-- Identifiants de l'utilisateur -->
                        <li class="nav-item text-light"><?php echo "Bonjour {$_SESSION['nom']}  {$_SESSION['prenom']}" ?></li>

                        <!-- Créer un trajet -->
                        <li class="nav-item text-light mx-3"><a class="btn btn-secondary" href="<?= BASE_URL ?>/form">Créer un trajet</a></li>

                        <!-- Déconnexion -->
                        <li class="nav-item"><a class="btn btn-danger" href="<?= BASE_URL ?>/logout">Déconnexion</a></li>
                        
                    <!-- Administrateur connecté -->
                    <?php elseif(isset($_SESSION['role_id']) && $_SESSION['role_id'] === 2): ?>
                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tableau de bord
                            </a>
                            <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Liste des utilisateurs</a>
                                <a class="dropdown-item" href="#">Liste des agences</a>
                                <a class="dropdown-item" href="#">Créer, modifier ou supprimer une ageance</a>
                                <a class="dropdown-item" href="#">Liste des trajets</a>
                                <a class="dropdown-item" href="#">Supprimer un trajet</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="btn btn-danger" href="<?= BASE_URL ?>/logout">Déconnexion</a></li>
                    
                    <!-- Utilisateur non connecté -->
                    <?php else : ?>
                        <li class="nav-item"><a class="btn btn-danger" href="<?= BASE_URL ?>/auth">Connexion</a></li>
                    <?php endif ?>

                </ul>
            </div>
        </div>
    </nav>
</header>