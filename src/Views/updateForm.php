<div class="container">
    <!-- Message d'erreur -->
    <?php if (isset($_SESSION['flash-error'])) {
        echo "<div class='alert alert-danger' role='alert'>{$_SESSION['flash-error']}</div>";
        unset ($_SESSION['flash-error']);
    } ?>
    
    <form action="<?= BASE_URL ?>/updateForm" method="POST">
    
        <!-- Agence de départ -->
        <div class="mb-3">
            <label for="agence_depart" class="form-label">Agence de départ</label>
            <select class="form-select" name="agence_depart_id" id="agence_depart_id">
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?php echo $agence['id'] ?>" <?php if($agence['id'] == $trajet['agence_depart_id']) echo 'selected' ?>>
                        <?php echo $agence['ville'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
    
        <!-- Date de départ -->
        <div class="mb-3">
            <label for="date_depart" class="form-label">Date de départ</label>
            <input type="datetime-local" class="form-control" name="date_depart" id="date_depart" value="<?php echo $trajet['date_depart'] ?>">
        </div>
    
        <!-- Agence d'arrivée -->
        <div class="mb-3">
            <label for="agence_arrivee" class="form-label">Agence d'arrivée</label>
            <select class="form-select" name="agence_arrivee_id" id="agence_arrivee_id">
                <?php foreach ($agences as $agence) : ?>
                    <option value="<?php echo $agence['id'] ?>" <?php if($agence['id'] == $trajet['agence_arrivee_id']) echo 'selected' ?>>
                        <?php echo $agence['ville'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
    
        <!-- Date d'arrivée -->
        <div class="mb-3">
            <label for="date_arrivee" class="form-label">Date d'arrivée</label>
            <input type="datetime-local" class="form-control" name="date_arrivee" id="date_arrivee" value="<?php echo $trajet['date_arrivee'] ?>">
        </div>
    
        <!-- Nombre total de places -->
        <div class="mb-3">
            <label for="nb_total_places" class="form-label">Nombre total de places</label>
            <input type="number" class="form-control" name="nb_total_places" id="nb_total_places" min="2" max="8" value="<?php echo $trajet['nb_total_places'] ?>">
        </div>
    
        <!-- Nombre total de places disponibles -->
        <div class="mb-3">
            <label for="nb_total_places_dispo" class="form-label">Nombre total de places disponibles</label>
            <input type="number" class="form-control" name="nb_total_places_dispo" id="nb_total_places_dispo" min="1" max="7" value="<?php echo $trajet['nb_total_places_dispo'] ?>">
        </div>
        
        <!-- Stocke l'ID du trajet -->
        <input type="hidden" name="trajet_id" value="<?php echo $trajet['id'] ?>">
    
        <!-- Bouton de validation -->
        <div class="container-fluid d-flex justify-content-center">
            <button type="submit" class="btn btn-secondary">Modifier le trajet</button>
        </div>
    </form>
</div>