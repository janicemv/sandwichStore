<?php

//Business/UserService.php

declare(strict_types=1);

namespace Business;

use Data\UserDAO;
use Entities\User;
use Exceptions\RegistrationException;


class UserService
{
    public function registerUser($email): ?int
    {
        $userDAO = new UserDAO();
        if ($userDAO->isUser($email) === null) {

            return $userDAO->addUser($email);
        } else {
            throw new RegistrationException('E-mail bestaat!');
        }
    }

    public function checkLogin($email, $password): bool
    {
        $userDAO = new UserDAO;
        $user = $userDAO->getUserByEmail($email);

        if ($user instanceof User) return $user && $user->getPassword() === $password;

        return false;
    }

    public function findUserbyEmail($email)
    {
        $userDAO = new UserDAO();
        $user = $userDAO->getUserByEmail($email);

        return $user;
    }

    public function getNewPassword($email)
    {
        $userDAO = new UserDAO();
        $newPassword = $userDAO->newPassword($email);

        return $newPassword;
    }
}
