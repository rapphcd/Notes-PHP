<?php session_start();
if (empty($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}
include 'includes/database.php';
global $db;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css" />
    <title><?= $_SESSION["username"] ?></title>
</head>

<body>
    <?php include "includes/navbar.php"; ?>
    <h1><?= $_SESSION['username'] ?></h1>
    <script src="/js/script.js"></script>
</body>

</html>