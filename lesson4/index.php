<?php
    // phpinfo();
    // $x = "Hello!";
    // print_r($x);

    // $var = 23.4;
    // echo gettype($var)."<br>";
?>
<?php
    // function displayPhpVersion(){
    //     echo "The PHP version is : " . phpversion();
    //     echo "\n";
    // }
    // displayPhpVersion();
?>
<?php 
    // function hello(){
    //     echo "Hello World!";
    // }
    // hello();
?>

<?php 
    // function sum(){
    //     $value = 120 + 20;
    //     echo $value;
    // }
    // sum();
?>

<?php 
    // function maximal($a,$b){
    //     if ($a > $b) {
    //         return $a;
    //     }else{
    //         return $b;
    //     }
    // }

    // $x = 25;
    // $y = 40;
    // $test = maximal($x,$y);

    // echo "The maximum value of $x and $y is $test";

?>

<?php 
    function fully_divisible($a){
        if ($a % 2 == 0){
            return "<br>$a is divisible by two"; 
        } else{
            return "<br>$a is not divisible by two  \n";
        }
    }

    print_r(fully_divisible(4));
    print_r(fully_divisible(5));
    print_r(fully_divisible(10));
    print_r(fully_divisible(15));
?>
