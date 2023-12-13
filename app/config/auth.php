<?php

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/User.php';

$database = new \App\Database();
$user = new \App\User();

if (empty($_POST['auth'])) {
    $auth_type = '';
} else {
    $auth_type = $_POST['auth'];
}

if ($auth_type == 'register'){
    $user->setName(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $user->setEmail(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL));
    $user->setPassword(filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $user->register_check();
    $database->insert_user($user->getName(), $user->getEmail(), $user->getHash());
} else if ($auth_type == 'login'){
    $user->setName(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $user->setPassword(filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $database->login_user($user->getName(), $user->getHash());
} else {
    $user->setName((string) $_COOKIE['user']);
    $user->logout();
}
header('Location: /web-oop/public/');