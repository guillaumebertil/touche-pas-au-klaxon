<!-- Liste des utilisateurs -->
    <div class="container">
        <div class="container text-center my-3">
            <h3>Liste des utilisateurs</h3>
        </div>
        <table class="table table-striped my-3">
            <!-- Table head -->
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Telephone</th>
                    <th>Email</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody>
                <?php foreach($users as $user) : ?>
                    <tr>
                        <td><?= $user['nom']; ?></td>
                        <td><?= $user['prenom']; ?></td>
                        <td><?= $user['telephone']; ?></td>
                        <td><?= $user['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>