<?php
// Presentation/extraLijst.php

declare(strict_types=1);

$title = "ExtraLijst"

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php" ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>
    <div class="container">
        <h1><?= $title ?></h1>

        <p> Je hebt <?= $myBroodje->getNaam(); ?> gekozen</p>

        <h3>Kies jouw extras:</h3>
        <?php if (!empty($extras)): ?>
            <form action="bestelController.php" method="post">
                <input type="hidden" name="broodId" value="<?= $_GET['broodId']; ?>">

                <?php foreach ($extras as $extra): ?>
                    <input type="checkbox" name="extras[]" value="<?= $extra->getExtraId(); ?>" id="<?= $extra->getExtraId(); ?>">
                    <label for="<?= $extra->getExtraId(); ?>"><?= $extra->getNaam(); ?> - € <?= number_format($extra->getPrijs(), 2, ',', '.'); ?></label>
                    <br>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary">Bestel</button>
            </form>


        <?php else: ?>
            <p>Geen extras gevonden.</p>
        <?php endif; ?>

    </div>

    <?php require_once "presentation/components/footer.html"; ?>

</body>

</html>