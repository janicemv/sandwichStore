<?php
// toonMandje.php

declare(strict_types=1);

spl_autoload_register();

$title = "Bestel Overzicht";


use Business\SessionService;
use Business\BestelService;
use Entities\Bestellijn;
use Entities\Bestelling;

$user = SessionService::getUser();

$currentTime = new DateTime();
$formattedDate = $currentTime->format('Y-m-d H:i:s');

//time for order validation
$limitTime = new DateTime('09:59');


$bestelling = SessionService::getBestelling();

if (!empty($bestelling)) {
    foreach ($bestelling as $bestellijnData) {
        $bestellijn = new Bestellijn($bestellijnData['broodje']);

        if (!empty($bestellijnData['extras'])) {
            foreach ($bestellijnData['extras'] as $extra) {
                $bestellijn->addExtra($extra);
            }
        }

        $bestelling->addBestellijn($bestellijn);
    }

    SessionService::addBestelling($bestelling);
}



include("presentation/bestelOverzicht.php");
