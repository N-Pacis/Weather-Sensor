<?php
    include_once("DataProcess.php");
    $obj = new DataProcess("data.txt");
    print $obj->presentDataFromFile();
?>