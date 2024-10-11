<?php
// Business/BestelService.php

declare(strict_types=1);

namespace Business;

use Entities\Bestellijn;
use Entities\Bestelling;
use Data\BestellingDAO;
use Exceptions\BestellingException;


class BestelService
{

    public function bestelBevestigen(int $userId, string $date, Bestelling $bestelling)
    {
        $bestelDAO = new BestellingDAO;

        return $bestelDAO->saveAll($userId, $date, $bestelling);
    }
}
