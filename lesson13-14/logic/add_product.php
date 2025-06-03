<?php

	include_once('../include/config.php');

	if(isset($_POST['submit']))
	{

        $title = $_POST['title'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $sql = "INSERT INTO products (title, description, quantity, price) VALUES (:title, :description, :quantity, :price)";
        $insertSql = $conn->prepare($sql);

        $insertSql->bindParam(':title', $title);
        $insertSql->bindParam(':description', $description);
        $insertSql->bindParam(':quantity', $quantity);
        $insertSql->bindParam(':price', $price);

        $insertSql->execute();

        echo "The product has been added successfully";
        echo "<br>";
        echo "<a href='../product_dashboard.php'>Product Dashboard</a>";
    }

?>