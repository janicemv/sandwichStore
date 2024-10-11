<?php
//toonextras.php /

declare(strict_types=1);

session_start();

spl_autoload_register();

use Business\BroodService;
use Business\ExtraService;

if (!isset($_GET['broodId']) || empty($_GET['broodId'])) {
    header("Location: index.php");
    exit;
}

$broodId = (int)$_GET['broodId'];

$broodDAO = new BroodService;
$myBroodje = $broodDAO->getBrood($broodId);

$extraSvc = new ExtraService();
$extras = $extraSvc->getAlleExtras();


include("Presentation/extraLijst.php");
