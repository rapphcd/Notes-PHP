<?php
$env = parse_ini_file('.env');
define("HOST", $env["HOST"]);;
define("DB_NAME", $env["DB_NAME"]);
define("USER", $env["USER"]);
define("PASS", $env["PASSWORD"]);

try {
    $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e;
}
?>