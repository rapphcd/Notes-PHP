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
<?php include "includes/navbar.php"; ?>
<div>
    <?php
    include 'includes/database.php';
    global $db;

    if(!empty($_SESSION['id'])){
        echo '<a href="add.php">ADD</a>';
        $q = $db->query("SELECT * FROM todos WHERE user = " . $_SESSION["id"] . " ORDER BY title ASC");
        while ($todo = $q->fetch()) { ?>
            <div>
                <h2>userid: <?= $todo['user'] ?></h2>
                <h1> <?= $todo["title"] ?></h1>
                <p><?= $todo["description"] ?></p>
                <a href="page.php?q=<?= $todo['id']; ?>">more</a>
            </div>
            <?php
        }
    }
    ?>
</div>
<script src="/js/script.js"></script>
</body>

</html>