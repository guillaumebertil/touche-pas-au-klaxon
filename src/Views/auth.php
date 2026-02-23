<div class="container border p-3">
    <?php if (isset($_SESSION['flash-error'])) {
        echo "<div class='alert alert-danger' role='alert'>{$_SESSION['flash-error']}</div>";
        unset ($_SESSION['flash-error']);
    } ?>
    <form action="<?= BASE_URL ?>/auth" method="POST">
        <div class="mb-3 py-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 py-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>