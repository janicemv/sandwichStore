<?php
// Presentation/broodLijst.php

declare(strict_types=1);

$title = "Broodlijst"

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php" ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>
    <div class="container">
        <h1><?= $title ?></h1>

        <?php if (!empty($broodjes)): ?>

            <table class="table">
                <tr class="table-primary">
                    <th>Broodje</th>
                    <th>Omschrijiving</th>
                    <th colspan="2">Prijs</th>
                </tr>
                <tbody>
                    <?php foreach ($broodjes as $brood): ?>
                        <tr>
                            <td><?= $brood->getNaam(); ?></td>
                            <td><?= $brood->getOmschrijving(); ?></td>
                            <td><?= $brood->getPrijs(); ?> €</td>
                            <td><a href="toonextras.php?broodId=<?= $brood->getId(); ?>">Bestel</a></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Geen broodjes gevonden.</p>
        <?php endif; ?>


        <?php require_once "presentation/components/footer.html"; ?>
    </div>
</body>

</html>