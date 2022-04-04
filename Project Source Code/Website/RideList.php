<?php
include './user_validation/login_validation.php'
?>
<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.2.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.2.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo6.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Ride List</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/formstyler/jquery.formstyler.css">
  <link rel="stylesheet" href="assets/formstyler/jquery.formstyler.theme.css">
  <link rel="stylesheet" href="assets/datepicker/jquery.datetimepicker.min.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <link rel="stylesheet" href="./navStyles.css">
  
  
</head>
<body>
  
 <nav>
            <div class="personal__logo">F.L.O.A.T.</div>
            <ul class="nav__link--list">
                <li>
                    <a href="" class="
                    nav__link--anchor
                    link__hover-effect
                    link__hover-effect--black
                    "> Hi, <?= $_SESSION['uName']?></a>
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
    


<section class="content4 cid-t07WYrRSIm" id="content4-8">

    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-md-12 col-lg-10">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2"><strong>Archived Rides</strong></h3>
            </div>
        </div>
    </div>
</section>    

<section class="form7 cid-t07XCkRQvm" id="form7-a">
    
<?php

    $dbname = 'boatRides';
    $dbuser = 'root';
    $dbpass = 'DQtLufu3aXfD';
    $dbhost = 'localhost';

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");

$rideQuery = "SELECT * FROM `rideCatalog`";
$rideRow = $link->query($rideQuery);
?>
<?php
while ($row = $rideRow->fetch_assoc()){
    $rideLocation = $row["location"];
    $rideDate = $row["rideDate"];
    $rideIdent = $row["rideID"];
?>   
    <div class="container">
    
        <div class="row justify-content-center mt-4">
            <div class="col-lg-8 mx-auto mbr-form">
                <form  method="POST" class="mbr-form form-with-styler mx-auto">
                    <h4 class="align-center">
                        <?=$rideLocation?>
                    </h4>
                    <hr>
                    <p class="mbr-text mbr-fonts-style align-center mb-4 display-7">
                        <?=$rideDate?>
                    </p> 
                       
                    <div class="col-auto mbr-section-btn align-center">
                        <input type ="hidden" name="rideID" value="<?=$rideIdent?>" />
                        <input type="submit" name="viewRide" class="btn btn-primary display-4" value="view">View</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 <?php
 if (isset($_POST['viewRide'])){
     $_SESSION["rideID"] =$_POST["rideID"];
     header("location: RideDetails.php");
     $link->close();
     exit();
 }
 ?>
 <?php
}
?>
</section>
   
  
  
</body>
</html>

