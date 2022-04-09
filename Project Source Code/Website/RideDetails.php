<?php
include './user_validation/login_validation.php';
?>
<!DOCTYPE html>
<html  >
<head>
  <?php    include './head.php'; ?>
  
  
  <link rel="stylesheet" href="./assets/styles/rideDetails.css">
  <title>Ride Details</title>
  <link rel="stylesheet" href="./assets/leaflet/leaflet.css"/>
  <script src="./assets/leaflet/leaflet.js"></script>
  
  
  
</head>
<body>
    <?php    
    include './navigationBar.php';
    include './databaseRidesConnect.php';
    
    $rideID = $_SESSION['rideID'];
    $rideQuery = "SELECT * FROM `rideCatalog` WHERE rideID= '$rideID'";
    $rideRow = $link->query($rideQuery);
    
        if ($row = $rideRow->fetch_assoc()){
            $rideLocation = $row["location"];
            $rideDate = $row["rideDate"];
            $rideStime = $row["startTime"];
            $rideEtime = $row["endTime"];
            $rideIdent = $row["rideID"];
            $rideDur = $row["duration"];
            $rideInfo = $row["csv"];
            $rideUser =  $row["registeredByID"];
        }
        
    include './databaseUsersConnect.php';
    $rideQuery = "SELECT username FROM `login_credentials` WHERE userID= '$rideUser';";
    $rideRow = $link->query($rideQuery);
        if ($row = $rideRow->fetch_assoc()){
            $rideUser = $row["username"];
        }
        
        if (($open = fopen($rideInfo, "r")) !== FALSE) {
            $rideNumReadings = 0;
            $rideAvgTemp= 0;
            $rideAvgHumid=0;
            while(list($currentTime,$latitude,$longitude,$turbidity,$temperature,$humidity,$litterDetect,$litterType) = fgetcsv($open,1024,',')) {
             
                if($currentTime != 'Current Time'){
                    $rideEntries["time"][$rideNumReadings] =$currentTime;
                    $rideEntries["latitude"][$rideNumReadings] =(float)$latitude;
                    $rideEntries["longitude"][$rideNumReadings] =(float)$longitude;
                    $rideEntries["turbidity"][$rideNumReadings] =(float)$turbidity * 50;
                    $rideEntries["temperature"][$rideNumReadings] =(float)$temperature;
                    $rideEntries["humidity"][$rideNumReadings] =(float)$humidity;
                    $rideEntries["litterDetect"][$rideNumReadings] =$litterDetect;
                    $rideEntries["litterType"][$rideNumReadings] =$litterType;
                    
                    
                    $rideAvgTemp += (float)$temperature;
                    $rideAvgHumid += (float)$humidity;
                    
                    $rideNumReadings += 1;
                }
                
                
            }
            
            
            $rideAvgTemp = $rideAvgTemp/$rideNumReadings;
            $rideAvgHumid = $rideAvgHumid/$rideNumReadings;
        }
        
        
    ?>
      

    <section class="content4 cid-t07TarkQ53" id="content4-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="title col-md-12 col-lg-10">
                    <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2"><strong>Summary of patrol</strong></h3>
                </div>
            </div>
        </div>
    </section>
    

    <section class="container">
        <div class="row justify-content-center mt-4">
            <div class="detail-column-auto ">
                <ul class="">
                    <li><strong>Location:</strong>
                        <br>
                        <?=$rideLocation?>
                    </li>
                    <li><strong>Start time:</strong>
                        <br>
                        <?=$rideStime?> 
                    </li>
                    <li><strong>End time:</strong>
                        <br>
                        <?=$rideEtime?>
                    </li>
                    <li><strong>Duration:</strong>
                        <br>
                         <?=$rideDur?>
                    </li>
                    <li><strong>Average Temperature:</strong>
                        <br>
                         <?=$rideAvgTemp?>
                    </li>
                    <li><strong>Average Relative Humidity:</strong>
                        <br>
                         <?=$rideAvgHumid?>
                    </li>
                    <li><strong>Registered By:</strong>
                        <br>
                         <?=$rideUser?>
                        
                    </li>
                    <li>
                        <br>
                        <a href="<?=$rideInfo?>">Get Full details</a>
                    </li>
                    
                </ul>
            </div>
            
            
            <div class="detail-item">    
                <div id="map">
                </div>
                
                <script>
                    var map = L.map('map').setView([<?=$rideEntries["latitude"][0]?>, <?=$rideEntries["longitude"][0]?>], 15);
             
                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 20,
                        id: 'mapbox/satellite-streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken: 'pk.eyJ1Ijoiam9uYmFydmFyZ2FzIiwiYSI6ImNsMHZmMHozazAyNWwzZXRjcW9wbWYzNGEifQ.LZ0UffVHXIPFBIAh7_-DaA'
                    }).addTo(map);
            
                    var mapCoord = [];
                </script>
                
                <?php
                    for ($index = 0; $index < $rideNumReadings; $index++){
                        $warningMessage ="";
                        $warningVal = 0;
                        $rideLitter ="";
                        
                ?>
                        <script>mapCoord.push([<?=$rideEntries["latitude"][$index]?>, <?=$rideEntries["longitude"][$index]?>]);</script>
                <?php
                
                        if ($rideEntries["turbidity"][$index] > 50.0){
                            $warningMessage = $warningMessage."<b>Turbidity warning</b><br>";
                            $warningVal += 1;
                ?>
                            <script>
                                
                                var circle = L.circle([<?=$rideEntries["latitude"][$index]?>, <?=$rideEntries["longitude"][$index]?>], {
                                    color: 'blue',
                                    fillColor: '#f03',
                                    fillOpacity: 0.1,
                                    radius: 30
                                }).addTo(map);
                                
                            </script>
                <?php  
                        }
                        
                        if($rideEntries["litterDetect"][$index] == 1){
                            $warningMessage = $warningMessage."<b>Litter detected</b><br>";
                            $warningVal += 1;
                ?>
                            
                            <script>
                                
                                var circle = L.circle([<?=$rideEntries["latitude"][$index]?>, <?=$rideEntries["longitude"][$index]?>], {
                                    color: 'red',
                                    fillColor: '#f03',
                                    fillOpacity: 0.1,
                                    radius: 50
                                }).addTo(map);
                                
                            </script>
                            
                 <?php       
                        }
                        
                        if($warningVal > 0){     
                ?>
                        <script>
                            var marker = L.marker([<?=$rideEntries["latitude"][$index]?>, <?=$rideEntries["longitude"][$index]?>]);
                            marker.bindPopup("<?=$warningMessage?>\n\
                                    <br>Time taken: <?=$rideEntries["time"][$index]?>\n\
                                    <br>Latitude: <?=$rideEntries["latitude"][$index]?>\n\
                                    <br>Longitude: <?=$rideEntries["longitude"][$index]?>\n\
                                    <br>Turbidity: <?=$rideEntries["turbidity"][$index]?> NTU\n\
                                    <br>Temperature: <?=$rideEntries["temperature"][$index]?>C\n\
                                    <br>Humidity: <?=$rideEntries["humidity"][$index]?>%\n\
                                    <br>Litter found: <?=$rideEntries["litterType"][$index]?> \n\
                                    ").openPopup();
    
                            marker.addTo(map);
                        </script>
                <?php
                        }
                    }
                ?>
                            
                            
                            
                <script>
                    var polygon = L.polyline(mapCoord, {fill: false});
                    polygon.addTo(map);
                </script>
                
          </div>
            
        
    </div>
</body>
</html>