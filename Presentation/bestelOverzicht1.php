<?php
// Presentation/bestelOverzicht.php

declare(strict_types=1);

spl_autoload_register();

$title = "Bestel Overzicht";

use Business\SessionService;

$user = SessionService::getUser();

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php"; ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>
    <div class="container">
        <h1><?= $title ?></h1>

        <?php if ($user): ?>
            <p><strong>Gebruiker:</strong> <?= htmlspecialchars($user->getEmail()) ?></p>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <th>Item</th>
            <th>Prijs</th>

            <tr>
                <td><?= $_SESSION['myBroodje']->getNaam(); ?></td>
                <td>€ <?= number_format($_SESSION['myBroodje']->getPrijs(), 2) ?></td>
            </tr>
            <?php if (isset($_SESSION['extras'])): ?>
                <?php foreach ($_SESSION['extras'] as $extraId): ?>
                    <?php
                    $extraDAO = new \Data\ExtraDAO();
                    $extra = $extraDAO->getExtraById((int)$extraId);
                    ?>
                    <tr>
                        <td><?= $extra->getNaam(); ?></td>
                        <td>€ <?= number_format($extra->getPrijs(), 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <tr class="table-info">
                <th>Totaal</th>
                <th>€ <?= number_format($_SESSION['totalPrijs'], 2) ?></th>
            </tr>
        </table>

        <?php require_once "presentation/components/footer.html"; ?>
    </div>

    <pre>
        <?php print_r($_SESSION); ?>
    </pre>
</body>

</html>