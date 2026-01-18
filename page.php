<?php session_start();
ob_start();

if (!isset($_GET['q']) || empty($_SESSION["id"])) {
    header("Location: index.php");
}

include 'includes/database.php';
global $db;

$id = (int)$_GET["q"];

$q = $db->prepare("SELECT * FROM todos WHERE id = :id AND user = :user");
$q->execute([
        'id' => $id,
        'user' => $_SESSION["id"]
]);

$result = $q->fetch();

if (!$result) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css"/>
    <title><?= $result['title'] ?></title>
</head>

<body>
<?php include "includes/navbar.php";?>
<section>
    <?php
    if ($result) {
        echo "<h1>" . $result['title'] ."</h1>";
        echo "<p>" . $result['description'] . "</p>";
    }

    echo '<form id="del" method="post"><button type="submit" name="submit" id="submit">Supprimer</button></form>';

    if (isset($_POST['submit'])) {
        $delRequest = $db->prepare("DELETE FROM todos WHERE id = :id");
        $delRequest->execute(["id" => $id]);
        header('Location: index.php');
        exit;
    }
    ob_end_flush();
    ?>
</section>
<script src="/js/script.js"></script>
</body>
</html>