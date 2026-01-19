<?php session_start();
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
<?php include "includes/navbar.php";

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
?>
<section id="todos">
    <div class="todos-container">
        <div class="todo-list">
            <div class="content">
                <?php
                if(!empty($_SESSION['id'])){
                    $q = $db->query("SELECT * FROM todos WHERE user = " . $_SESSION["id"] . " ORDER BY title ASC");
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
                        <?php
                    }
                    echo '<div class="add-todo-container"><a class="todo-element" href="add.php">ADD</a></div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div id="preview">

    </div>
</section>
<script src="/js/script.js"></script>
</body>

</html>