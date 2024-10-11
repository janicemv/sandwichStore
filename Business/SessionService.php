<?php
//Business/SessionService.php

namespace Business;

use Entities\User;
use Entities\Brood;
use Entities\Extra;
use Entities\Bestellijn;
use Entities\Bestelling;
use Exceptions\BestellingException;

session_start();

class SessionService
{
    // User Object in de session bewaren
    public static function addUser(User $user)
    {
        $_SESSION['user'] = serialize($user); // makes a string from object
    }

    //get User object back in overzicht
    public static function getUser(): ?User
    {
        return isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null; // turn it back to object
    }

    public static function addBestelling(Bestelling $bestelling)
    {
        $_SESSION['bestelling'] = serialize($bestelling);
    }

    // return array
    public static function getBestelling(): ?Bestelling
    {
        return isset($_SESSION['bestelling']) ? unserialize($_SESSION['bestelling']) : null; // turn it back to object
    }

    public static function clearBestelling(): void
    {
        unset($_SESSION['bestelling']);
    }

    public static function logout(): void
    {
        session_destroy();
    }
}
