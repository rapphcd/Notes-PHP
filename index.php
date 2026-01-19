<?php session_start();

if (empty($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

include 'includes/database.php';
global $db;

if (isset($_POST['submit']) && !empty($_POST['id'])) {
    $delRequest = $db->prepare("DELETE FROM todos WHERE id = :id AND user = :user");
    $delRequest->execute([
            "id" => $_POST['id'],
            "user" => $_SESSION['id']
    ]);
    header('Location: index.php');
    exit;
}

if (isset($_POST['addnote'])) {
    $addrequest = $db->prepare("INSERT INTO `todos`(`user`, `title`, `description`) VALUES (:userid,'New Note','...')");
    $addrequest->execute([
            "userid" => $_SESSION['id']
    ]);
    header('Location: index.php');
    exit;
}

if (isset($_POST['save']) && !empty($_POST['id'])) {
    $save = $db->prepare("UPDATE `todos` SET `title`= :title,`description`= :description WHERE id = :id");
    $save->execute([
            "id" => $_POST['id'],
            "title" => $_POST['title'],
            "description" => $_POST['description'],
    ]);
    header("Refresh:0");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css"/>
    <title>index</title>
</head>

<body>
<?php include "includes/navbar.php"; ?>
<section id="todos">
    <div class="todos-container">
        <div class="todo-list">
            <div class="content">
                <?php
                if (!empty($_SESSION['id'])) {
                    $q = $db->query("SELECT * FROM todos WHERE user = " . $_SESSION["id"] . " ORDER BY createdat ASC");
                    while ($todo = $q->fetch()) { ?>
                        <div class="todo-element" id="<?= $todo['id'] ?>"
                             onclick="selectTodo(<?= $todo['id'] ?>, '<?= addslashes($todo['title']) ?>', '<?= addslashes($todo['description']) ?>')">
                            <div class="todo-infos">
                                <h2> <?= $todo["title"] ?></h2>
                            </div>
                            <div class="todo-actions">
                                <form id="del" method="post">
                                    <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                                    <button class="del-todo" type="submit" name="submit" id="submit">DEL</button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                    <form id="addnote" method="post" class="add-todo-container">
                        <button type="submit" name="addnote" id="addnote" class="todo-element">ADD</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="preview">

    </div>
</section>
<script src="/js/script.js"></script>
</body>

</html>