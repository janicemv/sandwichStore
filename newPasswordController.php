<?php
// newPasswordController.php 

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\UserService;
use Exceptions\RegistrationException;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        // validate email 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $userService = new UserService();
            $newUser = $userService->getNewPassword($email);
            header("Location: index.php");
        } else {
            throw new RegistrationException('Invalid email!');
        }
    } catch (RegistrationException $e) {
        $error = urlencode($e->getMessage());
        header("Location: wachtwoordVergetten.php?error=$error");
    }
}
