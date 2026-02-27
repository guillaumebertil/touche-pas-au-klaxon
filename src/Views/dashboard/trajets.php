<!-- Tableau des trajets disponibles -->
    <div class="container">
        <div class="container text-center my-3">
            <h2>Liste des trajets disponibles</h2>
        </div>

        <!-- Message succès -->
        <?php if (isset($_SESSION['flash-success'])) {
            echo "<div class='alert alert-success' role='alert'>{$_SESSION['flash-success']}</div>";
            unset ($_SESSION['flash-success']);
        } ?>
        
        <!-- Message d'erreur -->
        <?php if (isset($_SESSION['flash-error'])) {
            echo "<div class='alert alert-danger' role='alert'>{$_SESSION['flash-error']}</div>";
            unset ($_SESSION['flash-error']);
        } ?>

        <table class="table table-striped my-3">

            <!-- Table head -->
            <thead>
                <tr>
                    <th>Agence de départ</th>
                    <th>Date de départ</th>
                    <th>Agence d'arrivée</th>
                    <th>Date d'arrivée</th>
                    <th>Nombre de places disponibles</th>
                    <th>Détails</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody>
                <?php foreach ($trips as $trip):?>
                <tr>
                    <td><?php echo $trip['ville_depart'] ?></td>
                    <td><?php echo $trip['date_depart'] ?></td>
                    <td><?php echo $trip['ville_arrivee'] ?></td>
                    <td><?php echo $trip['date_arrivee'] ?></td>
                    <td class="text-center"><?php echo $trip['nb_total_places_dispo'] ?></td>

                    <!-- Affiche le bouton "détails" si l'utlisateur est connecté -->
                    <?php if(isset($_SESSION['role_id'])) : ?>
                        <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#<?php echo $trip['trajet_id'] ?>detailsModal">Détails</button></td>

                        <!-- Modal de détails -->
                        <div class="modal fade" id="<?php echo $trip['trajet_id'] ?>detailsModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                <!-- Modal header -->
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Détails</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <ul>
                                        <li><?php echo "<b>Trajet proposé par :</b><br> {$trip['user_nom']} {$trip['user_prenom']}"?></li>
                                        <li><?php echo "<b>Téléphone :</b><br> {$trip['user_telephone']}"?></li>
                                        <li><?php echo "<b>Adresse email :</b><br> {$trip['user_email']}"?></li>
                                        <li><?php echo "<b>Nombre de places disponibles :</b><br> {$trip['nb_total_places']}"?></li>
                                    </ul>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Si l'utilisateur est l'auteur du trajet, on affiche les boutons modifier et supprimer -->
                        <td>
                            <!-- Bouton "supprimer" -->
                            <form action="<?= BASE_URL ?>/dashboard/deleteTrajets" method="POST" class="d-inline">
                                <input type="hidden" name="trajet_id" value="<?php echo $trip['trajet_id']?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>

                    <?php endif ?>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>