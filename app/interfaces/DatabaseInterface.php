<?php

namespace App;

interface DatabaseInterface
{
    public function check_user(string $user_name, string $user_email): void;
    public function insert_user(string $user_name, string $user_email, string $hash): void;
    public function login_user(string $user_name, string $hash): void;
    public function query(string $sql, array $params);
}