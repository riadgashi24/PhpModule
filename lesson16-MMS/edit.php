<?php
    include_once('config.php');
    
    $id= $_GET['id'];


    $sql = "UPDATE * FROM movies WHERE id=:id";

    $deleteUsers = $conn -> prepare($sql);
    $deleteUsers -> bindParam(':id' , $id);
    $deleteUsers ->execute();
    $user_data = $selectUsers -> fetch();

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
        <h2>Edit User's Details</h2>
        <div class= "table-responsive">
            <form action="updateUsers.php" method="post">
                <div class= "form-floating">
                    <input type="number" class="form-control" id="floatingInput" placeholder="id" name="id" value="<?php echo $data[$id]?>"></br>
                    <label for="id">ID</label>
                </div>
                                <div class= "form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name" name="name" value="<?php echo $data[$name]?>"></br>
                    <label for="id">ID</label>
                </div>
                <div class= "form-floating">
                    <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" value="<?php echo $data[$username]?>"></br>
                    <label for="id">ID</label>
                </div>
                <div class= "form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="email" name="email" value="<?php echo $data[$email]?>"></br>
                    <label for="id">ID</label>
                </div>
                <br>
                <button class="w-100 btn-Ig btn-primary" type="submit" name="submit">Change</button>
            </form>
        </div>
</body>
</html>