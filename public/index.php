<?php
    require_once __DIR__ . '/../app/classes/Database.php';
    require_once __DIR__ . '/../app/classes/TaskManager.php';
    $database = new \App\Database();
    $taskManager = new \App\TaskManager($database);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include_once('php/header.php');
    ?>
    <div class="container">
        <h1>ToDo List</h1>
        <form action="/web-oop/app/config/tasksController.php" method="post" class="todo-form">
            <?php
            if ($_COOKIE['user'] == '') :
                ?>
                <div class="add-task">
                    <label class="task-label">Add new task:</label>
                    <input type="text" name="task" placeholder="You mast log in or register!" class="input-task" readonly>
                    <button type="submit" name="task-type" value="add" class="btn-submit" disabled>Submit</button>
                </div>
            <?php else : ?>
                <div class="add-task" >
                    <label class="task-label">Add new task:</label>
                    <input type="text" name="task" placeholder="To do..." class="input-task">
                    <button type="submit" name="task-type" value="add" class="btn-submit">Submit</button>
                </div>
            <?php endif; ?>
            <hr>
        </form>
        <?php
        if (!empty($_COOKIE['user'])) {
            $query = $taskManager->get_tasks_query();
            echo '<ul class="tasks-list">';
            while($row = $query->fetch(PDO::FETCH_OBJ)){
                echo
                "<li>
				<b class='task-label'> {$row->task} </b>";

                if ($row->status == 0) {
                    echo "<a href='/web-oop/app/config/tasksController.php?id={$row->id}'><input type='checkbox' name='check-task'></a>";
                } else {
                    echo "<a href='/web-oop/app/config/tasksController.php?id={$row->id}'><input type='checkbox' name='check-task' checked></a>";
                }

                echo	"
				<span>Added by user: {$row->user} | </span>
				<span>{$row->data}</span>
				<a href='/web-oop/app/config/tasksController.php?id={$row->id}&task-type=delete'><button>Remove</button></a>
			</li>";
            }
            echo '</ul>';
        }
        ?>
    </div>
</body>
</html>