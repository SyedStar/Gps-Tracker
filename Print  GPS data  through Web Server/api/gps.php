<?php
            
        $Sw1 = $_REQUEST["u_lon"];
        $Sw2 = $_REQUEST["u_lat"];
            
        $servername = 'localhost';  
        $username = 'root';  
        $password = '';  
        $dbname = 'invenlly_syed';  
			
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql = "UPDATE gps SET lat=$Sw2, lon=$Sw1 WHERE id=1";
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully2"
           // header("location: gpsiot.php");
        } 
        else {
            echo "Error updating record: " . $conn->error;
        }
        $conn->close();
   
?>