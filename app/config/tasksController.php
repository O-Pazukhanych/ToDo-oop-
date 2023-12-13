<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/TaskManager.php';
$database = new \App\Database();
$taskManager = new \App\TaskManager($database);

if (!empty($_POST['task-type'])){
    $task_op = $_POST['task-type'];
} else if (!empty($_GET['task-type'])) {
    $task_op = $_GET['task-type'];
} else {
    $task_op = '';
}

if ($task_op == 'add'){
    if (empty($_POST['task'])) {
        echo "Please enter the task";
        exit();
    }
    $task = $_POST['task'];
    $user = $_COOKIE['user'];

    $taskManager->add_task((string) $task, (string) $user);
}
else if ($task_op == 'delete'){
    $id = $_GET['id'];

    $taskManager->delete_task($id);
}
else {
    $id = $_GET['id'];

    $taskManager->update_task($id);
}


header('Location: /web-oop/public/');
