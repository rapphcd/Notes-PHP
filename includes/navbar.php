<div>
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']);
    echo "<a href='deconnexion.php'>Log out</a>";
    echo "<a href='login.php'>Login</a>";
    echo "<a href='register.php'>Register</a>";
    echo "<a href='profil.php'>Profil</a>";

    if ($currentPage != 'index.php') {
        echo "<a href='index.php'>Accueil</a>";
    }
    ?>
</div>