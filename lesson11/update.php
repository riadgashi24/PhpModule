<?php
    include_once("config.php");

    if (isset($_POST["update"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
    }

?>