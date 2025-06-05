<?php 
require 'config.php';
session_start();

if(isset($_POST['submit']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];


  if(empty($username) || empty($password))
  {
    echo "Fill all the fields!";
    header( "refresh:2; url=login.php" ); 
  }else{
    $sql = "SELECT * FROM users WHERE username=:username";
    $insertSql = $conn->prepare($sql);
    $insertSql->bindParam(':username', $username);


    $insertSql->execute();
    
    if($insertSql->rowCount() > 0) {
        $data=$insertSql->fetch();
        if(password_verify($password,$data['password'])){
          $_SESSION['username']= $data['username'];
          echo "Perhajr Bajrami!";
          // header("Location: ../dashboard.php");
        }else{
          echo "Password incorrect";
          header( "refresh:2; url=../login.php" );
        }
    } else {
        echo "User not found!!";
    }
  }
}

