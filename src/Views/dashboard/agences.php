<!-- Liste des agences -->
<div class="container">

    <div class="container text-center my-3">
        <h3>Liste des agences</h3>
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

    <div class="container d-flex justify-content-end mb-3">
        <!-- Ajouter un trajet -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createAgenceModal">
            Ajouter un trajet
        </button>

        <?php require __DIR__ . '/_modal_create_agence.php'; ?>
    </div>

    <!-- Tableau des agences -->
    <table class="table table-striped my-3">

        <!-- Table head -->
        <thead>
            <tr>
                <th class="w-75">Ville</th>
                <th class="w-25 text-center">Action</th>
            </tr>
        </thead>

        <!-- Table body -->
        <tbody>
            <?php foreach($agences as $agence) : ?>
                <tr>
                    <td><?= $agence['ville']; ?></td>
                    <td class="text-center">

                        <!-- Modifier un trajet -->
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#updateAgenceModal<?= $agence['ville'] ?>">
                            Modifier
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="updateAgenceModal<?= $agence['ville'] ?>" tabindex="-1" role="dialog" aria-labelledby="updateAgenceModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                <!-- Modal header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateAgenceModalTitle">Modifier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="<?= BASE_URL ?>/dashboard/updateAgences" method="POST">
                                        <div class="mb-3">
                                            <label for="ville" class="form-label">Nom de la ville</label>
                                            <input type="text" class="form-control" id="ville" name="ville" value="<?= $agence['ville'] ?>">
                                            <input type="hidden" name="agence_id" value="<?= $agence['id'] ?>">
                                        </div>

                                        <div class="container d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal">Annuler</button>
                                            <button type="submit" class="btn btn-success mx-2">Modifier</button>
                                        </div>
                                    </form>
                                </div>

                                </div>
                            </div>
                        </div>

                        <!-- Bouton "supprimer" -->
                        <form action="<?= BASE_URL ?>/dashboard/deleteAgences" method="POST" class="d-inline">
                            <input type="hidden" name="agence_id" value="<?php echo $agence['id']?>">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
