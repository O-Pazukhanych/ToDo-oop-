<?php

namespace App;

require_once __DIR__ . '/../interfaces/TaskManagerInterface.php';
class TaskManager implements TaskManagerInterface
{
    private Database $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function get_tasks_query()
    {
        $sql = 'SELECT * FROM `tasks`';
        $query = $this->database->query($sql);
        return $query;
    }

    public function add_task(string $task, string $user): void
    {
        $sql = 'INSERT INTO tasks(task, user) VALUES(:task, :user)';
        $this->database->query($sql, ['task' => $task, 'user' => $user]);
    }

    public function delete_task(int $id): void
    {
        $sql = 'DELETE FROM `tasks` WHERE `id` = ?';
        $this->database->query($sql, [$id]);
    }

    public function update_task(int $id): void
    {
        $status = $this->get_task_status($id);
        $status = ($status == 0) ? 1 : 0;

        $sql = 'UPDATE `tasks` SET `status` = :status WHERE `id` = :id';
        $this->database->query($sql, ['id' => $id, 'status' => $status]);
    }

    public function get_task_status(int $id)
    {
        $sql = 'SELECT `status` FROM `tasks` WHERE `id` = ?';
        $query = $this->database->query($sql, [$id]);
        return $query->fetch()[0];
    }
}