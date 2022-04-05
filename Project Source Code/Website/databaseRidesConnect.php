<?php
$dbname = 'boatRides';
    $dbuser = 'root';
    $dbpass = 'DQtLufu3aXfD';
    $dbhost = 'localhost';
    


$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");
?>