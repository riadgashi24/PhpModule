<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Minichallenge</title>
</head>
<body>
    <?php
        $store = array(
            array("Iphone 14",20,10),
            array("Iphone 13",20,20),
            array("Iphone 12",20,25),
            array("Iphone 11",25,40)
        );
        echo "<table>";
        echo "<tr><th>Phones</th><th>In stock</th><th>Sold</th><tr>";
        for ($row=0;$row<4;$row++){
            echo "<tr>";
            for($col=0;$col<3;$col++){
                echo "<td>".$store[$row][$col]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        
    ?>
</body>
</html>