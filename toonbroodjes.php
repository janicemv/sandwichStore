<?php
//toonbroodjes.php /

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\BroodService;
use Business\ExtraService;

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$broodSvc = new BroodService();
$broodjes = $broodSvc->getAlleBroodjes();

include("presentation/broodLijst.php");
