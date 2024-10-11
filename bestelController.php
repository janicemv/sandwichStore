<?php
// bestelController.php

declare(strict_types=1);

spl_autoload_register();

use Entities\Bestellijn;
use Entities\Bestelling;
use Business\BroodService;
use Business\ExtraService;
use Business\SessionService;
use Exceptions\BestellingException;

try {

    $bestelling = SessionService::getBestelling();

    if ($bestelling == null) {
        $date = new DateTime();
        $formattedDate = $date->format('Y-m-d H:i:s');

        $bestelling = new Bestelling(SessionService::getUser()->GetUserId(), $formattedDate, 1);
        SessionService::addBestelling($bestelling);
    }


    if ($_SERVER["REQUEST_METHOD"] === "POST") {


        if (isset($_POST['broodId'])) {
            $broodId = (int)$_POST['broodId'];

            $broodService = new BroodService();
            $eenBrood = $broodService->getBrood($broodId);

            $bestellijn = new Bestellijn($eenBrood);

            if (isset($_POST['extras'])) {
                $extrasIds = $_POST['extras'];

                $extraService = new ExtraService();

                foreach ($extrasIds as $extraId) {
                    $extra = $extraService->getExtra((int)($extraId));
                    $bestellijn->addExtra($extra);
                }
            }

            $bestelling->addBestellijn($bestellijn);

            SessionService::addBestelling($bestelling);

            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
} catch (BestellingException $e) {
    $errorMessage = $e->getMessage();
}

header("Location: toonMandje.php");
exit(0);
