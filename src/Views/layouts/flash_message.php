<!-- Message succès -->
<div class="container my-3 w-50">
    <?php if (isset($_SESSION['flash-success'])) {
        echo "<div class='alert alert-success' role='alert'>{$_SESSION['flash-success']}</div>";
        unset ($_SESSION['flash-success']);
    } ?>
    
    <!-- Message d'erreur -->
    <?php if (isset($_SESSION['flash-error'])) {
        echo "<div class='alert alert-danger' role='alert'>{$_SESSION['flash-error']}</div>";
        unset ($_SESSION['flash-error']);
    } ?>
</div>