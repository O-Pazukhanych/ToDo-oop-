<?php

namespace App;

interface UserInterface
{
    public function register_check(): void;
    public function logout(): void;
}