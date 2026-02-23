<div>
    <?php if (isset($_SESSION['flash-success'])) {
        echo "<div class='alert alert-success' role='alert'>{$_SESSION['flash-success']}</div>";
        unset ($_SESSION['flash-success']);
    } ?>
    <h1>Touche pas au klaxon !</h1>
    <p>Site en construction.</p>
</div>