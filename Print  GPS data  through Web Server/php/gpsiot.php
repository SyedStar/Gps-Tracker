<?php

  $servername = 'localhost';  
	$username = 'root';  
	$password = '';  
	$dbname = 'invenlly_syed';  
	//require_once('config.php');
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT * FROM gps where id=1";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()) {
    $lat = $row["lat"];
    $lon = $row["lon"];
  }
  $conn->close();
?>


<!DOCTYPE html>
<html>
  <head>
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <link rel="stylesheet" href="/gps/css/gpsiot.css">
  </head>
  <body>
    <div id="map"></div>
      <script>
         window.setInterval('refresh()', 10000); 	// Call a function every 10000 milliseconds (OR 10 seconds).

        // Refresh or reload page.
        function refresh() {
          window .location.reload();
        }
        function initMap() {
          str = <?= $lat ?> ;
          str = <?= $lon ?>;
          var demomap = {lat: <?= $lat ?> , lng: <?= $lon ?> };
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 20,
            center: demomap
          });
          var marker = new google.maps.Marker({
            position: demomap,
            map: map
          });
        }
      </script>
      <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApgXbnEijZ78MPyDkBhwdomJh05eKsX9o&callback=initMap">
      </script>
    <div class="box">
        <h2>Google Maps</h2><br>
          <table border ='3' class="tab-align" style="background:transparent" >
			      <tr>
			        <th class="tdx"><h4>&nbspLatitude&nbsp</h4></th>
			        <th class="tdx"><h4>&nbspLongitude&nbsp</h4></th>
			      </tr>
    </div>
  
			 
    <?php 


    	echo "<tr>";
      echo "<td class=\"tabl\">"; echo $lat; echo "</td>";
      echo "<td class=\"tabl\">"; echo $lon; echo "</td>";
      echo "</tr>";
    ?>
     </table>  
    
  </body>
</html>
