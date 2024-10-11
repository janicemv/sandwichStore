<?php
// test.php
declare(strict_types=1);

spl_autoload_register();

//use Data\BroodDAO;
//use Data\ExtraDAO;
use Exceptions\RegistrationException;

use Data\UserDAO;
use Entities\User;
use Business\UserService;
use Entities\Bestelling;
use Entities\Bestellijn;
use Entities\Brood;
use Entities\Extra;
use Business\BestelService;
use Data\BestellingDAO;
use Data\DBConfig;
use PharIo\Manifest\Email;

// UserService
//$userService = new UserService();

//$user = $userService->registerUser('jaaam@oi.com.br');

//print_r($user);

//$loggin = $userService->checkLogin('oi@oi.com.br', 'aBCd');

//var_dump($loggin);
//
//function findUserbyEmail($email)
//{
//    $userDAO = new UserDAO();
//    $user = $userDAO->getUserByEmail($email);
//
//    return $user;
//}
//
//$user = $userService->findUserbyEmail('oi@oi.com.br');
//print_r($user);

// broodjes ophalen uit de database
$broodjeHam = new Brood(1, 'Ham', 'Broodje met ham', 3.0);
$broodjeKaas = new Brood(2, 'Kaas', 'Broodje met kaas', 3.0);
$broodjeBoulet = new Brood(3, 'Boulet', 'Broodje met koude boulet', 3.5);

// extra's ophalen uit de database
$extraMayo = new Extra(1, 'Mayonaise', 0.2);
$extraSla = new Extra(2, 'Sla', 0.1);
$extraTomaat = new Extra(3, 'Tomaat', 0.1);

$date = new DateTime();
$formattedDate = $date->format('Y-m-d H:i:s');

// een user meld zich aan, op dat moment kan een bestelling-object aangemaakt worden
$bestelling = new Bestelling(3, $formattedDate, 1);

// de user start met bestellen, een bestellijn-object wordt aangemaakt
$bestellijn_1 = new Bestellijn($broodjeHam);
$bestellijn_1->addExtra($extraMayo);
$bestellijn_1->addExtra($extraSla);

// de bestellijn wordt aan de bestelling toegevoegd
$bestelling->addBestellijn($bestellijn_1);

//de user wil een 2de broodje bestellen dus een tweede bestellijn-object wordt gemaakt
$bestellijn_2 = new Bestellijn($broodjeBoulet);
$bestellijn_2->addExtra($extraMayo);
$bestellijn_2->addExtra($extraSla);
$bestellijn_2->addExtra($extraTomaat);

// ook deze bestellijn toevoegen aan de bestelling
$bestelling->addBestellijn($bestellijn_2);

// en hetzelfde voor een derde bestellijn
$bestellijn_3 = new Bestellijn($broodjeKaas);

$bestelling->addBestellijn($bestellijn_3);

// bekijk de inhoud van de objecten goed,
// je zal zien dat per lijn een prijs berekend wordt
// en de totaalprijs (alle bestellijnen samen) wordt ook berekend in het bestelling-object
print_r($bestelling);
//
//$bestelSvc = new BestelService();
//
//$bestellijn_4 = $bestelSvc->getBroodFromLine($broodjeHam);
//
//print_r($bestellijn_4);
//
//$extras_2 = $bestelSvc->getExtrasFromLine($bestellijn_2);
//
//print_r($bestellijn_2);

$dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

// $sql = "INSERT INTO broodjes_bestellingen (userId, date, statusID)
//                 VALUES (:userId, :date, :statusID)";
// $stmt = $dbh->prepare($sql);
// $stmt->execute([
//     ':userId' => 5,
//     ':date' => $formattedDate,
//     ':statusID' => 1
// ]);
// 
// $bestellingID = $dbh->lastInsertId();
// 
// $dbh = null;
// 
// print($bestellingID);
// 

//$sql = "INSERT INTO broodjes_extras_lijnen (lijnId, extraId)
//       VALUES (:lijnId, :extraId)";
//$stmt = $dbh->prepare($sql);
//$stmt->execute([
//    ':lijnId' => 2,
//    ':extraId' => 5,
//]);

//$dbtest = new BestellingDAO;
//
//$savetest = $dbtest->saveAll(3, $formattedDate, $bestelling);
//
//print_r($savetest);

//$servicetest = new BestelService;
//
//$save = $servicetest->bestelBevestigen(3, $formattedDate, $bestelling);
//
//print_r($save);

$userDAO = new UserService;

$newPassword = $userDAO->getNewPassword('jmv@gmail.com');

print_r($newPassword);
