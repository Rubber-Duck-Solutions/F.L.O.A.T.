<?php
include './user_validation/login_validation.php'
?>
<!DOCTYPE html>
<html  >
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="assets/images/logo6.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Ride Details</title>
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <link rel="stylesheet" href="./assets/styles/rideDetails.css">
  <link rel="stylesheet" href="./navStyles.css">
  
  <link rel="stylesheet" href="./assets/leaflet/leaflet.css"/>
  <script src="./assets/leaflet/leaflet.js"></script>
  <!-- comment <link rel="stylesheet" href="./newride.css"> -->
  
  
</head>
<body>
  
    <nav>
            <div class="personal__logo">F.L.O.A.T.</div>
            <ul class="nav__link--list">
                <li>
                    <a href="rideList.php" class="
                    nav__link--anchor
                    link__hover-effect
                    link__hover-effect--black
                    "> yuh Hi, <?= $_SESSION['uName']?></a>
                </li>
                <li>
                    <a href="RideList.php" class="
                    nav__link--anchor
                    link__hover-effect
                    link__hover-effect--black
                    "> Home</a>
                </li>
                <li>
                    <a href="logout.php" class="
                    nav__link--anchor
                    nav__link--anchor--primary
                    ">Log Out</a>
                </li>
            </ul>
        </nav>


    <?php
    $dbname = 'boatRides';
    $dbuser = 'root';
    $dbpass = 'DQtLufu3aXfD';
    $dbhost = 'localhost';
    
    $rideID = $_SESSION['rideID'];

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");

$rideQuery = "SELECT * FROM `rideCatalog` WHERE rideID= '$rideID'";
$rideRow = $link->query($rideQuery);
?>
        
<?php
if ($row = $rideRow->fetch_assoc()){
    $rideLocation = $row["location"];
    $rideDate = $row["rideDate"];
    $rideStime = $row["startTime"];
    $rideEtime = $row["endTime"];
    $rideIdent = $row["rideID"];
    $rideDur = $row["duration"];
    $rideInfo = $row["csv"];
}
?>
        
<?php
$rideQuery = "SELECT * FROM `rideLinks` WHERE rideID= '$rideID'";
$rideRow = $link->query($rideQuery);

if ($row = $rideRow->fetch_assoc()){
    $ridemymaps = $row["mymaps"];
    $ridecsv = $row["csvFile"];
    
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

<section class="content14 cid-t07YzbCA5o" id="content14-b">
    
    
    
    <div class="detail-container ">
        
            <div class="detail-item-column ">
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
                </ul>
                
            </div>
            <div class="detail-item">
                
                <div id="map">
                    <p>yeah</p>
                </div>
                
                <script>
            var map = L.map('map').setView([50.436, -104.547], 13);
             
             L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/satellite-streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoiam9uYmFydmFyZ2FzIiwiYSI6ImNsMHZmMHozazAyNWwzZXRjcW9wbWYzNGEifQ.LZ0UffVHXIPFBIAh7_-DaA'
            }).addTo(map);
            
            var mapCoord = [];
<?php
 if (($open = fopen($rideInfo, "r")) !== FALSE) 
  {
     while(list($currentTime,$latitude,$longitude,$sensorReading) = 
             fgetcsv($open,1024,',')) { 
         if($currentTime != 'Current Time'){
         $latitude =(float)$latitude;
         $longitude =(float)$longitude;
         $sensorReading =(float)$sensorReading;
        if($sensorReading > 0.0){
         
         
            
?>
        var marker = L.marker([<?=$latitude?>, <?=$longitude?>]);
        var circle = L.circle([<?=$latitude?>, <?=$longitude?>], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.1,
        radius: 30
        }).addTo(map);
        marker.bindPopup("<b>Turbidity warning</b>\n\
                          <br>Time taken: <?=$currentTime?>\n\
                          <br>Latitude: <?=$latitude?>\n\
                          <br>Longitude: <?=$longitude?>\n\
                          <br>Turbidity: <?=$sensorReading?> NTU").openPopup();
        marker.addTo(map);
        
 <?php
         }
 ?>
    mapCoord.push([<?=$latitude?>, <?=$longitude?>]);

 
<?php
         }
             }
  }
 
?>
        var polygon = L.polyline(mapCoord, {fill: false});
    polygon.addTo(map);
        </script>
                <iframe src="<?=$ridemymaps?>" width="640" height="480"></iframe>
                <iframe src="<?=$ridecsv?>" width="640" height="480"></iframe>
                
            </div>
            
        
    </div>
        

  
</body>
</html>