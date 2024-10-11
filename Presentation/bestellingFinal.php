<?php
// Presentation/bestellingFinal.php

declare(strict_types=1);

spl_autoload_register();

$title = "Bestelling Bevestigd!";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>
    <div class="container">
        <h1><?= $title ?></h1>

        <?php if ($user): ?>
            <h2><strong>Jouw bestellingnummer:</strong> <?= $bestelId ?></h2>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>



        <?php require_once "presentation/components/footer.html"; ?>
    </div>
</body>

</html>