<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/html.html to edit this template
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
        <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script type="text/javascript" src="/assets/PapaParse-5.0.2/papaparse.min.js"></script>
   
    </head>
    <body>
        
        <div style="height: 640px; length:640px;" id="map"></div>
        
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
 if (($open = fopen("testmap.csv", "r")) !== FALSE) 
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
        
   
        
            
        
