<?php

$file = fopen("tasks.txt","r");

$header = fgetcsv($file,0,"\t");

echo implode("\t",$header)."\n";

while (($row = fgetcsv($file,0,"\t")) !== false) {
    echo implode("\t" ,$row)."\n";
}

?>