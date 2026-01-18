<?php
session_start();
ob_start();
if (!empty($_SESSION['id'])) {
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
    <title>login</title>
</head>

<body>
<?php include "includes/navbar.php"; ?>
<section>
    <form id="form" method="post">
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="submit" name="submit" id="submit" value="Login">
    </form>
    <?php
    include 'includes/database.php';
    global $db;

    if (isset($_POST['submit'])) {
        extract($_POST);

        if (empty($username) || empty($password)) {
            echo "Veuillez remplir tout les champs";
            return;
        }

        $q = $db->prepare("SELECT * FROM users WHERE username = :username");
        $q->execute(['username' => $username]);
        $result = $q->fetch();
        if ($result != true) {
            echo "Aucun compte n'est associé à ce pseudo";
            return;
        }
        $hashpass = $result['password'];
        if (password_verify($password, $hashpass)) {
            $_SESSION['username'] = $result['username'];
            $_SESSION['id'] = $result['id'];
            $_SESSION['permissions'] = $result['permissions'];
            header('Location: index.php');
            exit;
        } else {
            echo "Mot de passe incorrect";
        }
    }

    ob_end_flush();
    ?>
</section>
<script src="/js/script.js"></script>
</body>

</html>