<?php

namespace App;

require_once __DIR__ . '/../interfaces/DatabaseInterface.php';

class Database implements \App\DatabaseInterface
{
    private $pdo;

    public function __construct()
    {
//        $dsn = 'mysql:host=127.0.0.1;dbname=to-do';
//        $this->pdo = new \PDO($dsn, 'root');
        $dsn = 'mysql:host=sql305.infinityfree.com;dbname=if0_35606818_todo';
        $this->pdo = new \PDO($dsn, 'if0_35606818', 'HYlaOVf7RORR');
    }

    public function check_user(string $user_name, string $user_email): void
    {
        $query = $this->pdo->query('SELECT * FROM `users`');
        while ($row = $query->fetch(\PDO::FETCH_OBJ)){
            if ($row->user_name == $user_name || $row->user_email == $user_email){
                echo "This name or email is already in use!";
                exit();
            }
        }
    }

    public function insert_user(string $user_name, string $user_email, string $hash): void
    {
        $this->check_user($user_name, $user_email);

        $sql = 'INSERT INTO users(user_name, user_email, password) VALUES(:user_name, :user_email, :password)';
        $query = $this->pdo->prepare($sql);
        $query->execute(['user_name' => $user_name, 'user_email' => $user_email, 'password' => $hash]);
        setcookie('user', $user_name, time() + 3600, "/web-oop/public/");
    }

    public function login_user(string $user_name, string $hash): void
    {
        $sql = 'SELECT * FROM `users` WHERE `user_name` = :user_name AND `password` = :hash';
        $query = $this->pdo->prepare($sql);
        $query->execute(['user_name' => $user_name, 'hash' => $hash]);

        $user = $query->fetch();
        if(count($user) == 0){
            echo "Incorrect login or password";
            exit();
        } else {
            setcookie('user', $user_name, time() + 3600, "/web-oop/public/");
        }
    }

    public function query(string $sql, array $params = [])
    {
        $query_res = $this->pdo->prepare($sql);
        $query_res->execute($params);
        return $query_res;
    }
}