<?php
// Presentation/registerForm.php

declare(strict_types=1);

$title = "Registratie";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "presentation/components/head.php" ?>

<body>
    <?php require_once "presentation/components/menu.php"; ?>
    <div class="container">
        <h1><?= $title ?></h1>
        <div class="form-row align-items-center">
            <div class="col-sm-3 my-1">


                <form action="registerController.php" method="post">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success">Registreren</button>
                    </div>
                </form>


                <?php
                if ($error): ?>
                    <div class="alert alert-danger">
                        <p class="error"><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>