<?php
    include_once('config.php');
    
    $id= $_GET['id'];


    $sql = "UPDATE FROM users WHERE id=:id";

    $deleteUsers = $conn -> prepare($sql);
    $deleteUsers -> bindParam(':id' , $id);
    $deleteUsers ->execute();
    header('Location:dashboard.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        form>input{
            margin-bottom: 10px;
            font-size: 20px;
            padding: 5px;
        }
        button{
            background-color: transparent;
            border: 1px solid black;
            padding: 10px 40px;
            font-size: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $data[$id]?>"></br>
            <input type="text" name="name" value="<?php echo $data[$name]?>"></br>
            <input type="text" name="surname" value="<?php echo $data[$surname]?>"></br>
            <input type="email" name="email" value="<?php echo $data[$email]?>"></br>
            <button type="submit" name="update">Update</button>
        </form>
</body>
</html>