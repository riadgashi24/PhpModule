<?php

// $my_file = fopen("ds.txt","w");

// $my_filename = "ds.txt";
// $my_file = fopen($my_filename,"w");
// $size = filesize($my_file);
// $my_filedata = fread($my_file,$size);


// $file = fopen("ds.txt","r");

// while (!feof($file)) {
//     echo fgets($file);
// }

// fclose($file);

//  w- write only mode


// r - read only mode


// a - write only mode. Te dhenat ne files ruhen


// w+ , r+ , a+ 

// $file = fopen("ds.txt","r");

// $text = "Digital school";

// fwrite($file,$text);
file_put_contents("ds.txt","Add more text...");
echo file_get_contents("ds.txt");

?>