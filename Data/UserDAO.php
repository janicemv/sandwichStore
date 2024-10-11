<?php

//Data/UserDAO.php

declare(strict_types=1);

namespace Data;

use \PDO;
use Data\DBConfig;
use Entities\User;

class UserDAO
{
    public function isUser(string $email): ?int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT id FROM users WHERE email =:email";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([':email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;

        return $result ? (int) $result['id'] : null;
    }

    private function generateRandomPassword(int $length = 4): string
    {
        $karakters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';

        for ($i = 0; $i < $length; $i++) {
            $random = random_int(0, strlen($karakters) - 1);
            $password .= $karakters[$random];
        }

        return $password;
    }

    public function addUser(string $email): int
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $dbh->prepare($sql);
        $password = $this->generateRandomPassword();
        $stmt->execute([':email' => $email, ':password' => $password]);
        $userID = $dbh->lastInsertId();
        $dbh = null;

        return (int) $userID;
    }

    public function getUserByEmail(string $email): ?User
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT id, email, password FROM users WHERE email = :email";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([':email' => $email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;

        if ($result) {
            return new User((int) $result['id'], $result['email'], $result['password']);
        } else {
            return null;
        }
    }

    public function getUserById(int $userID): User
    {

        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $sql = "SELECT id, email, password FROM users WHERE id = :userID";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':userID' => $userID));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = new User((int)$userID, $rij['email'], $rij['password']);

        $dbh = null;

        return $user;
    }

    public function newPassword(string $email)
    {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);

        $newPassword = $this->generateRandomPassword();

        $sql = "UPDATE users SET password = :password WHERE email = :email";

        $stmt = $dbh->prepare($sql);

        $stmt->execute([
            ':password' => $newPassword,
            ':email' => $email
        ]);

        return $newPassword;
    }
}
