<?php

	include_once('config.php');	

	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$surname = $_POST['surname'];
        $username = $_POST['username'];
		$email = $_POST['email'];
		$tempPassword = $_POST['password'];
        $password = password_hash($tempPassword, PASSWORD_DEFAULT);

        if (empty($name)||empty($surname)||empty($username)||empty($email)||empty($password)) {
            echo "You need to fill all of the fields";
        }else {
            $sql = "SELECT FROM users WHERE username=:username";
            $tempSql = $conn->prepare($sql);
        
            $tempSql->bindParam(':username', $username); 
            $tempSql->execute();    
            
            if ($tempSql -> rowCount()>0) {
                echo "Username exists!"; 
                header("refresh:2; url= login.php");
            }else {
                $sql = "INSERT INTO users (name,surname,username, email, password) VALUES (:name,:surname,:username, :email, :password)";
                $insertSql = $conn -> prepare($sql);
                $insertSql->bindParam(':name', $name);
                $insertSql->bindParam(':surname', $surname);
                $insertSql->bindParam(':username', $username);
                $insertSql->bindParam(':email', $email);
                $insertSql->bindParam(':password', $password);

                $insertSql -> execute();

                echo "Data saved succesfully!";
                header("refresh:2; url=login.php");
            }
        }


	}
?>