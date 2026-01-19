<?php
session_start();
ob_start();

if (!empty($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}

include 'includes/database.php';


if (isset($_POST['submit'])) {

    extract($_POST);

    if (empty($username) || empty($password)) {
        echo "Veuillez remplir tout les champs";
        return;
    }

    global $db;

    $check = $db->prepare("SELECT username FROM users WHERE username = :username");
    $check->execute([
            'username' => $username
    ]);
    $result = $check->rowCount();

    if ($result >= 1) {
        echo "username déja utilisé";
        return;
    }

    $options = [
            'cost' => 13,
    ];
    $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);

    $add = $db->prepare("INSERT INTO users(username,password) VALUES(:username,:password)");
    $add->execute([
            'username' => $username,
            'password' => $hashpass
    ]);

    $q = $db->prepare("SELECT * FROM users WHERE username = :username");
    $q->execute(['username' => $username]);
    $result = $q->fetch();

    $_SESSION['username'] = $username;
    $_SESSION['id'] = $result['id'];
    $_SESSION['permissions'] = $result['permissions'];

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
    <title>register</title>
</head>

<body>
<?php include "includes/navbar.php"; ?>
<section>
    <div class="login-content">
        <form id="form" method="post">
            <input type="text" name="username" id="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit" name="submit" id="submit" value="Register">REGISTER</button>
        </form>
    </div>
</section>
<script src="/js/script.js"></script>
</body>

</html>