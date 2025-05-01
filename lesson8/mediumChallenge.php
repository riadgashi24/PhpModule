<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=db", 'root', '');
    echo "Connected to database successfully.<br>";

    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "Tables in the database:<br>";
    foreach ($tables as $table) {
        echo "- $table<br>";
    }

    $stmt = $pdo->query("DROP TABLE movies");
    if ($stmt) {
        echo "Table 'movies' dropped successfully.<br>";
    } else {
        echo "Failed to drop table 'movies'.<br>";
    }

    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "Tables in the database:<br>";
    foreach ($tables as $table) {
        echo "- $table<br>";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>