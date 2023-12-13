<?php

namespace App;

interface TaskManagerInterface
{
    public function get_tasks_query();
    public function add_task(string $task, string $user): void;
    public function delete_task(int $id): void;
    public function update_task(int $id): void;
    public function get_task_status(int $id);
}