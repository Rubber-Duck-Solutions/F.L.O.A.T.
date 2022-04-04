<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride details</title>
    <link rel="stylesheet" href="./styles.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>
<body>
    <section id="about-me">
        <nav>
            <div class="personal__logo">F.L.O.A.T.</div>
            <ul class="nav__link--list">
                <li>
                    <a href="rideList.php" class="
                    nav__link--anchor
                    link__hover-effect
                    link__hover-effect--black
                    "> Hi, <?= $_SESSION['uName']?></a>
                </li>
                <li>
                    <a href="rideList.php" class="
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
        
        <div class="
                    flex
                    flex-1">
            <div class="about-me__info row">
              <div class="about-me__info--container">
                  
                  <p class="about-me__info--para">
                        Summary of patrol
                  </p>
               </div>
                
                <div class="about-me__info--container">
                  
                  <p class="about-me__info--para">
                        Location: <?=$rideLocation?>
                  </p>
                  <p class="about-me__info--para">
                        Start time: <?=$rideStime?> 
                  </p>
                  <p class="about-me__info--para">
                        End time: <?=$rideEtime?>
                  </p>
                  <p class="about-me__info--para">
                        Duration: <?=$rideDur?>
                  </p>
               </div>
                
               <figure class="about-me__img--container">
                   <iframe src="<?=$ridemymaps?>" width="640" height="480"></iframe>

               </figure>
               <figure class="about-me__img--container">
		 <iframe src="<?=$ridecsv?>"></iframe>

	       </figure>
            </div>
        </div>
</body>
</html><!-- comment -->