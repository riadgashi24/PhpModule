<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT users WHERE (username, hashedPassword) VALUES ($username, $password)";
    $result = mysqli_query($pdo, $sql);
    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
    } else {
        echo "Username ose password gabim! <br><a href='login_form.php'>Kthehu</a>";
    }

}
?>
