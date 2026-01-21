<div style="display: flex; width: 100%; justify-content: center;align-items: center; position: fixed; bottom: 0">
    <div style="display: flex;justify-content: space-around;width: 20rem;padding:0.5rem 0 0.5rem 0;background-color: var(--gray);z-index: 100; color: white;margin: 0.5rem;border-radius: 2rem">
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']);

        if (empty($_SESSION['id'])) {
            if ($currentPage != 'login.php') {
                echo "<a class='navitems' href='login.php'>Login</a>";
            }
            if ($currentPage != 'register.php') {
                echo "<a class='navitems' href='register.php'>Register</a>";
            }
        } else {
            echo "<a class='navitems' href='deconnexion.php'>Log out</a>";
        }

        ?>
    </div>
</div>
<style>
    .navitems {
        padding: 1rem;
        border-radius: 1rem;
        border: 1px solid transparent;
    }

    .navitems:hover{
        border: 1px solid var(--secondary);
    }
</style>