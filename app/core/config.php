<?php
    $db_username   = "root";
    $db_password   = "";
    $dbname     = "onlystages_bd";
    $host = "localhost";

    // Identifiants propres à la machine, facultatifs et non versionnés
    if (is_file(__DIR__ . '/config.local.php')) {
        require __DIR__ . '/config.local.php';
    }

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $db_username, $db_password);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        die("Erreur : connexion à la base de données impossible.");
    }
?>
