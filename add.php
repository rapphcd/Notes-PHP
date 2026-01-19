<?php session_start();
if (empty($_SESSION['id']) && $_SESSION['perms'] != 5) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <title>add</title>
</head>

<body>
<?php include "includes/navbar.php"; ?>
<section>
    <form id="add" method="post" enctype="multipart/form-data">
        <input type="text" id="title" name="title" placeholder="Nom" required>
        <textarea id="description" name="description" rows="4" cols="50"></textarea>
        <input type="submit" name="submit" id="submit">
    </form>
    <?php

    include 'includes/database.php';

    if (isset($_POST['submit'])) {

        extract($_POST);

        if (empty($title) || empty($description)) {
            echo "Veuillez remplir tout les champs";
            return;
        }

        global $db;
        $q = $db->prepare("INSERT INTO todos (title,user,description) VALUES(:title,:user,:description)");
        $q->execute([
                'title' => $title,
                'user' => $_SESSION['id'],
                'description' => $description
        ]);
        echo " ADDED";
    }
    ?>
</section>
<script src="/js/script.js"></script>
</body>

</html>