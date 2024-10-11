<?php
// bevestigenController.php

declare(strict_types=1);

spl_autoload_register();


use Business\SessionService;
use Business\BestelService;
use Exceptions\BestellingException;


$user = SessionService::getUser();
$bestelling = SessionService::getBestelling();

$bestelService = new BestelService();

if (!$user || empty($bestelling)) {
    header("Location: index.php");
    exit();
}

try {

    $userId = $user->getUserID();
    $date = new DateTime();
    $formattedDate = $date->format('Y-m-d H:i:s');


    $bestelId = $bestelService->bestelBevestigen($userId, $formattedDate, $bestelling);

    header("Location: toonBestelling.php?bestelId=$bestelId");


    SessionService::clearBestelling();

    exit();
} catch (BestellingException $e) {

    $errorMessage = $e->getMessage();
}
