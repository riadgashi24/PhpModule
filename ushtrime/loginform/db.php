<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "ushtrime";

    try {
        $pdo = new PDO("mysql:host=$server;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOExpection $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    
?>