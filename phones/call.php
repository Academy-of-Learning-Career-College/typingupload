<?php

if (isset($_GET["number"])) {
    $number = $_GET["number"];
    $phone = $_GET["phone"];
    $file = fopen($phone . ".txt","w");
    fwrite($file, $number . "\n");
    fclose($file);
    echo "Value written to file";
} else {
    echo "No value provided";
}

?>
