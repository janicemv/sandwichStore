<?php

//Data/BroodDAO.php

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\Brood;

class BroodDAO
{
    public function getBroodjes(): array
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT broodjeId, naam, omschrijving, prijs FROM broodjes ORDER BY naam";
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $brood = new Brood((int) $rij["broodjeId"], $rij["naam"], $rij["omschrijving"], (float) $rij["prijs"]);
            array_push($lijst, $brood);
        }

        $dbh = null;
        return $lijst;
    }

    public function getBroodById(int $broodjeId): Brood
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT broodjeId, naam, omschrijving, prijs FROM broodjes WHERE broodjeId = :broodjeId";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':broodjeId' => $broodjeId));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $brood = new Brood((int)$broodjeId, $rij['naam'], $rij['omschrijving'], (float)$rij['prijs']);

        $dbh = null;

        return $brood;
    }
}
