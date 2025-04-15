<?php
    // $dogs = array(
    //     array("Husky","siberis",15),
    //     array("Husky","siberis",15),
    //     array("Husky","siberis",15)
    // );

    // echo $dogs[0][0].": orgin:".$dogs[0][1].": life-spam:".$dogs[0][2]."<br>";
    // echo $dogs[1][0].": orgin:".$dogs[1][1].": life-spam:".$dogs[1][2]."<br>";
    // echo $dogs[2][0].": orgin:".$dogs[2][1].": life-spam:".$dogs[2][2]."<br>";

    // for($row=0;$row<3;$row++){
    //     echo "<p><b> Row Number $row </b></p>";
    //     echo "<ul>";
    //     for($col=0; $col<3;$col++){    
    //         echo "<li>".$dogs[$row][$col]."</li>";
    //     }
    //     echo "</ul>";
    // }

?>
<?php
    // $array = array(
    //     array(1,2,3),
    //     array(1,2,3),
    //     array(1,2,3)
    // );

    // for($i=0;$i<4;$i++){
    //     for ($j=0; $j <4 ; $j++) { 
    //         echo "Array $i of $j <br>";
    //     }
    // }
?>
<?php
    // for ($i=0; $i < 10; $i++) { 
    //     for ($j=$i; $j <10; $j++) { 
    //         echo "&nbsp"; 
    //     }
    //     for ($j=0; $j <$i; $j++) { 
    //         echo "*"; 
    //     }
    //     echo "<br>";
    // }
?>

<?php
    $grades = array(
        "Math" => 5,
        "Music" => 5,
        "PE" => 5,
        "Physis" => 5,
        "Chemistry" => 5
    );

    // echo "Math grade is:".$grades["Math"];




    foreach($grades as $subject => $grade){
        echo "Subject: $subject,  Grade: $grade <br>";
    }
    
?>