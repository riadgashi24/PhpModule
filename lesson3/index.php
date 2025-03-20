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
        $day = "E enjte";
        $x = 1;
        $y = 1;

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
            echo "$numri is positive". "<br>";
        }else if ($numri == 0) {
            echo "$numri is 0";
        }else{
            echo "$numri is negative". "<br>";
        }

        switch ($age2) {
            case $age2 <= 0 && $age2 >= 18:
                echo "You are a minor". "<br>";
                break;
            case $age2 >= 19  && $age2 <= 25:
                echo "You are a young adult". "<br>";
                break;
            case $age2 >= 26:
                echo "You are an adult". "<br>";
                break;

            default:
                echo "Invalid age" . "<br>";
        }

        switch ($day){
            case "E hene":
                echo "Sot eshte e hene";
                break;
            case "E marte":
                echo "Sot eshte e marte";
                break;
            case "E merkure":
                echo "Sot eshte e merkure";
                break;
            case "E enjte":
                echo "Sot eshte e enjte";
                break;
            case "E premte":
                echo "Sot eshte e premte";
                break;
            case "E shtune":
                echo "Sot eshte e shtune";
                break;
            case "E diel":
                echo "Sot eshte e diel";
                break; 
        }

        while ($x <= 5) {
            
            echo "<br>Number is $x";
            $x++;
        }

        do{
            echo "<br>Number is $y";
            $y++; 
        }while ($y <= 5);

        for ($x = 0; $x <= 10; $x++) {
            echo "<br>  The number is: $x";
        }
    ?>

    <?php
    
    $cars = array("BMW","Mercedes","Volvo");
    foreach ($cars as $car) {
        echo "<br>$car";
    }

    ?>

    <?php
        $mosha = array("John" => "18","Ben"=>"20","Joe"=>"30");
        foreach ($mosha as $a => $b) {
            echo "<br>$a: $b";
        }
    ?>
</body>
</html>