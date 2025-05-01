<?php
    $pdo = new PDO("mysql:host=localhost;dbname=db", "root", "");
    // $sql = "CREATE TABLE movies (
    // id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    // name VARCHAR(30) NOT NULL,year INT(4) NOT NULL,
    // genre VARCHAR(30) NOT NULL,
    // rating FLOAT(3,1) NOT NULL)";

    $sql = "INSERT INTO movies (name, year, genre, rating) VALUES
    ('The Shawshank Redemption', 1994, 'Drama', 9.3),
    ('The Godfather', 1972, 'Crime', 9.2),
    ('The Dark Knight', 2008, 'Action', 9.0),
    ('Pulp Fiction', 1994, 'Crime', 8.9),
    ('Forrest Gump', 1994, 'Drama', 8.8),
    ('Inception', 2010, 'Sci-Fi', 8.8),
    ('Fight Club', 1999, 'Drama', 8.8),
    ('The Matrix', 1999, 'Sci-Fi', 8.7),
    ('Goodfellas', 1990, 'Crime', 8.7),
    ('The Lord of the Rings: The Return of the King', 2003, 'Fantasy', 8.9)";
    $pdo -> exec($sql);
    echo "Data inserted successfully";
    //echo "Table created successfully";
?>