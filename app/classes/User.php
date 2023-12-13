<?php

namespace App;

require_once __DIR__ . '/../interfaces/UserInterface.php';

class User implements \App\UserInterface
{
    private string $name;
    private string $email;
    private string $password;
    private string $hash;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
        $this->hash = md5($this->password . 'secret');
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function register_check(): void
    {
        if (mb_strlen($this->name) < 3) {
            echo "Minimum name length is 3 characters";
            exit();
        } else if (mb_strlen($this->password) < 6) {
            echo "Minimum password length is 6 characters";
            exit();
        }
    }

    public function logout(): void
    {
        setcookie('user', $this->name, -0, "/web-oop/public/");
    }
}