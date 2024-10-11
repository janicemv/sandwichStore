<?php
// Presentation/loginForm.php

declare(strict_types=1);

$title = "Login";

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

                <form action="loginController.php" method="post">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success">Login</button>
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
        <p><a href="registration.php">Registreren</a></p>
        <p><a href="wachtwoordVergetten.php">Wachtwoord vergetten</a></p>
    </div>
    </div>
</body>

</html>