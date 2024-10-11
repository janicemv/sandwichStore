<?php
// Presentation/bestelOverzicht.php

declare(strict_types=1);

spl_autoload_register();

$title = "Bestel Overzicht";

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

        <table class="table table-hover">

            <thead>
                <tr class="table-info">
                    <th>Broodje</th>
                    <th>Extras</th>
                    <th>Prijs</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($bestelling)):
                    foreach ($bestelling->getBestellijnen() as $bestellijn): ?>
                        <tr>
                            <td><?= htmlspecialchars($bestellijn->GetBrood()->getNaam()); ?></td>
                            <td>
                                <?php if (!empty($bestellijn->GetExtras())): ?>
                                    <?php foreach ($bestellijn->GetExtras() as $extra): ?>
                                        <?= htmlspecialchars($extra->getNaam()); ?>,
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    Geen extras
                                <?php endif; ?>
                            </td>
                            <td>€ <?= number_format($bestellijn->getTotalPrijs(), 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="table-secondary">
                        <th colspan="2">Totaal</th>
                        <th>€ <?= number_format($bestelling->getTotaal(), 2); ?></th>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Geen bestellingen gevonden.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a class="btn btn-primary" href="toonbroodjes.php" role="button">Broodje Toevoegen</a>

        <?php if ($currentTime <= $limitTime): ?>
            <a class="btn btn-success" href="bevestigenController.php" role="button">Bestelling Bevestigen</a>
        <?php else: ?>
            <div class="alert alert-danger">
                <p>Je kan tot 9:59u bestellen. Probeer opnieuw morgen!</p>
            </div>
        <?php endif; ?>

        <?php require_once "presentation/components/footer.html"; ?>
    </div>

</body>

</html>