<?php
include_once('config.php');

if(isset($_POST['submit'])){
    $movies_name = $_POST['movie_name'];
    $movie_desc = $_POST['movie_desc'];
    $movie_quality = $_POST['movie_quality'];
    $movie_rating = $_POST['movie_rating'];
    $movie_image = $_POST['movie_image'];

    $sql = "INSERT INTO movies(movie_name, movie_desc, movie_quality, movie_rating, movie_image) VALUES (:movie_name, :movie_desc, :movie_quality, :movie_rating, :movie_image)";

    $insertMovie = $conn -> prepare($sql);
	$prep->bindParam(':movie_name', $movie_name);
	$prep->bindParam(':movie_desc', $movie_desc);
	$prep->bindParam(':movie_quality', $movie_quality);
	$prep->bindParam(':movie_rating', $movie_rating);

	$prep->execute();

	header("Location:dashboard.php");
}
?>