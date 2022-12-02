<?php
class DataProcess{
    private $FILENAME = "";
    
    public function __construct($any_filename){
        $this->FILENAME = $any_filename;
    }
    public function getTimestamp($offsetParam){
        #Offset is the number of hours counted from GMT.
        $offsetToSeconds=$offsetParam*60*60; #converting offset to seconds
        $dateFormat="Y-m-d H:i:s";
        return gmdate($dateFormat, time()+$offsetToSeconds);
    } 
    
    public function appendDataToFile($dataParam){
        $f = fopen($this->FILENAME, "a");
        fwrite($f, $dataParam);
        fclose($f);        
    }
    private function readDataFromFile(){   
        #read file content
        $f=fopen($this->FILENAME, "r");
        $content="";
        while(!feof($f)){
            $content.= fgets($f)."\n";
        }
        fclose($f); 
        return $content;
    } 
    
    public function presentDataFromFile(){
        print "<style>";
        print "
            table { 
                border-spacing: 10px;
                border-collapse: collapse;
            }
            td,th{
                border: 1px solid #AAA;
                padding: 5px;
                text-align: left;
            }
        ";
        print "</style>";
        
        print "<table>";
            print "<tbody>";
                print "<tr>";
                    print "<th>Timestamp</th>";
                    print "<th>Device</th>";
                    print "<th>Temperature</th>";
                    print "<th>Humidity</th>";
                    print "<th>Heat Index</th>";
                print "</tr>";
                #Parse the content to get line after line
                foreach(explode("\n",$this->readDataFromFile()) as $row):
                    if(!empty($row)){
                        $column = explode(" -- ",$row);
                        $timestamp=$column[0];
                        $device=$column[1];
                        $temperature = $column[2]." <sup>o</sup>C";
                        $humidity=$column[3];
                        $heat_index=$column[4];
                        print "<tr>";
                            print "<td>".$timestamp."</td>";
                            print "<td>".$device."</td>";
                            print "<td>".$temperature."</td>";
                            print "<td>".$humidity."</td>";
                            print "<td>".$heat_index."</td>";
                        print "</tr>";
                    }
                endforeach;
            print "</tbody>";
        print "</table>";
    }
}
?>