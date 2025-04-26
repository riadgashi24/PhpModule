<?php
    $host = "localhost";
    $db = "db";
    $user = "root";
    $pass = "";

    try{
        $pdo = New PDO("mysql:host=$host; dbname = $db", $user , $pass);
        $sql = "CREATE TABLE USERS (id INT (6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL)";

        $pdo -> exec($sql);
        echo "Table created seccessfuly";
    }
    catch(Exception $e){
        echo "Error creating table:" . $e ->getMessage();
    }
?>