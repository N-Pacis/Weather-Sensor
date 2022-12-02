<?php
    if(!empty($_REQUEST["device"]) && !empty($_REQUEST["temperature"])){
        include_once("DataProcess.php");
        $obj = new DataProcess("data.txt");
        $dataArg = $obj->getTimestamp(2) # In Rwanda the offset is 2 hours
                    ." -- "
                    .$_REQUEST["device"]
                    ." -- "
                    .$_REQUEST["temperature"]
                    ." -- "
                    .$_REQUEST["humidity"]
                    ." -- "
                    .$_REQUEST["heat_index"]
                    ."\n";
        $obj->appendDataToFile($dataArg);
        print "Success";
    }
    else{
        print "Empty Data!";
    }
?>