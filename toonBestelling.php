<?php
// toonBestelling.php

declare(strict_types=1);

spl_autoload_register();

use Business\SessionService;


$user = SessionService::getUser();

if (!isset($_GET['bestelId']) || empty($_GET['bestelId'])) {
    header("Location: index.php");
    exit;
}

$bestelId = (int) $_GET['bestelId'];

include("Presentation/bestellingFinal.php");
