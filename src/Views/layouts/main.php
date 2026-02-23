<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/main.css">
    <title>Touche pas au klaxon</title>
</head>
<body>

    <!-- Header -->
    <?php require 'header.php' ?>

    <!-- Main -->
    <?php require __DIR__ . '/../' . $view . '.php'; ?>
    
    <!-- Footer -->
    <?php require 'footer.php' ?>
</body>
</html>