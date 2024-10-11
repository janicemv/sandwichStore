<?php

//Data/BroodDAO

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Exceptions\BestellingException;
use Entities\Bestelling;
use Entities\Bestellijn;


class BestellingDAO
{

    public function saveAll(int $userId, string $date, Bestelling $bestelling)
    {

        try {
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbh->beginTransaction();

            $sql = "INSERT INTO broodjes_bestellingen (userId, date, statusID)
                        VALUES (:userId, :date, :statusID)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':userId' => $userId,
                ':date' => $date,
                ':statusID' => 1
            ]);
            if (!$stmt->rowCount()) {
                throw new BestellingException("fout bij bestelling bewaren");
            }

            $bestelId = (int)$dbh->lastInsertId();

            foreach ($bestelling->getBestellijnen() as $bestellijn) {

                $sql = "INSERT INTO broodjes_bestellijnen (bestelId, broodjeId, totaalPrijs)
       VALUES (:bestelId, :broodjeId, :totaalPrijs)";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([
                    ':bestelId' => $bestelId,
                    ':broodjeId' => $bestellijn->GetBrood()->getId(),
                    ':totaalPrijs' => $bestellijn->getTotalPrijs()
                ]);
                if (!$stmt->rowCount()) {
                    throw new BestellingException("fout bij bestellijn bewaren");
                }

                $bestellijnId = (int)$dbh->lastInsertId();

                if (!empty($bestellijn->getExtras())) {
                    foreach ($bestellijn->getExtras() as $extra) {

                        $sql = "INSERT INTO broodjes_extras_lijnen (lijnId, extraId)
       VALUES (:lijnId, :extraId)";
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute([
                            ':lijnId' => $bestellijnId,
                            ':extraId' => $extra->getExtraId(),
                        ]);
                        if (!$stmt->rowCount()) {
                            throw new BestellingException("fout bij extra bewaren");
                        }
                    }
                }
            }


            $dbh->commit();
            $dbh = null;

            return $bestelId;
        } catch (BestellingException $e) {
            if ($dbh) {
                $dbh->rollBack();
            }
            throw new BestellingException("Bestelling was niet bewaard: " . $e->getMessage());
        }
    }
}
