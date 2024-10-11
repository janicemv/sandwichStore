<?php

//Business/ExtraService.php

declare(strict_types=1);

namespace Business;

use Data\ExtraDAO;

class ExtraService
{
    public function getAlleExtras(): array
    {
        $extraDAO = new ExtraDAO();
        $lijst = $extraDAO->getExtras();
        return $lijst;
    }

    public function getExtra($extraId)
    {
        $extraDAO = new ExtraDAO();
        $extra = $extraDAO->getExtraById($extraId);

        return $extra;
    }
}
