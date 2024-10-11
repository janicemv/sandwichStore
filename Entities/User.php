<?php

//Entities/User.php

declare(strict_types=1);

namespace Entities;

class User
{
    private int $id;
    private string $email;
    private string $password;

    public function __construct(?int $id, string $email, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(string $email, string $password, ?int $id = null)
    {
        return new User($id, $email, $password);
    }

    // Getters
    public function getUserID(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
