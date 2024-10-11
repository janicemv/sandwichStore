<?php

//Data/ExtraDAO.php

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Extra;

class ExtraDAO
{
    public function getExtras(): array
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT extraId, naam, prijs FROM extras ORDER BY naam";
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $extra = new Extra((int) $rij["extraId"], $rij["naam"], (float) $rij["prijs"]);
            array_push($lijst, $extra);
        }

        $dbh = null;
        return $lijst;
    }

    public function getExtraById(int $extraId): Extra
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT extraId, naam, prijs FROM extras WHERE extraId = :extraId";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':extraId' => $extraId));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $extra = new Extra((int)$extraId, $rij['naam'], (float)$rij['prijs']);

        $dbh = null;

        return $extra;
    }
}
