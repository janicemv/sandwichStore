<?php

//Business/BroodService.php

declare(strict_types=1);

namespace Business;

use Data\BroodDAO;

class BroodService
{
    public function getAlleBroodjes(): array
    {
        $broodDAO = new BroodDAO();
        $lijst = $broodDAO->getBroodjes();
        return $lijst;
    }

    public function getBrood($broodId)
    {
        $broodDAO = new BroodDAO();
        $brood = $broodDAO->getBroodById($broodId);

        return $brood;
    }
}
