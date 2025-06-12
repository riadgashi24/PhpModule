<?php
include_once('config.php');

$id = $_GET["id"];

$sql = "DELETE FROM movies WHERE id=:id";

$deleteUsers = $conn -> prepare($sql);
$deleteUsers -> bindParam(':id', $id);
$deleteUsers -> execute();
header("Location: list_movies.php");

?>
