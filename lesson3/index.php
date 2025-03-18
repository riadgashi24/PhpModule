<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson 3</title>
</head>
<body>
    <?php
    
        $num = -10;
        $age = 54;
        $numri = 33;
        $age2 = 23;

        if ($num > 10) {
            echo "Numri eshte me i madh se 10";
        }else{
            echo "Numri eshte me i vogel se 10" . "<br>";
        }

        if (($age>13) && ($age< 20)) {
            echo "You are a teenager";
        }else{
            echo "You are a grown man" . "<br>";
        }

        if ($numri > 0) {
            echo "$numri is positive";
        }else if ($numri == 0) {
            echo "$numri is 0";
        }else{
            echo "$numri is negative";
        }

        switch ($age2) {
            case $age2 <= 0 && $age2 >= 18:
                echo "You are a minor";
                break;
            case $age2 >= 19  && $age2 <= 25:
                echo "You are a young adult";
                break;
            case $age2 >= 26:
                echo "You are an adult";
                break;

            default:
                echo "Invalid age";
        }
    ?>
</body>
</html>