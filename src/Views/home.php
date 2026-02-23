<div>
    <?php if (isset($_SESSION['flash-success'])) {
        echo "<div class='alert alert-success' role='alert'>{$_SESSION['flash-success']}</div>";
        unset ($_SESSION['flash-success']);
    } ?>
    <div class="container">
        <div class="container text-center">
            <h2>Liste des trajets disponibles</h2>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Agence de départ</th>
                    <th>Date de départ</th>
                    <th>Agence d'arrivée</th>
                    <th>Date d'arrivée</th>
                    <th>Nombre de places disponibles</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trips as $trip):?>
                <tr>
                    <td><?php echo $trip['ville_depart'] ?></td>
                    <td><?php echo $trip['date_depart'] ?></td>
                    <td><?php echo $trip['ville_arrivee'] ?></td>
                    <td><?php echo $trip['date_arrivee'] ?></td>
                    <td class="text-center"><?php echo $trip['nb_total_places_dispo'] ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>