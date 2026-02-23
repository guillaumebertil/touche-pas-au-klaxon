<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/main.css">
    <title>Touche pas au klaxon</title>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <?php require 'header.php' ?>

    <!-- Main -->
    <div class="d-flex justify-content-center align-items-center flex-grow-1 bg-light">
        <?php require __DIR__ . '/../' . $view . '.php'; ?>
    </div>
    
    <!-- Footer -->
    <?php require 'footer.php' ?>
</body>
</html>