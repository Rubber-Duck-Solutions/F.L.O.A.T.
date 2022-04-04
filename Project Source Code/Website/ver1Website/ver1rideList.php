<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride list</title>
    <link rel="stylesheet" href="./styles.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>
<body>
    <section id="about-me">
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
    <div>
        <p> <?=$rideLocation?> </p>
        <p> <?=$rideDate?> </p>
        <form method="POST">
            <input type ="hidden" name="rideID" value="<?=$rideIdent?>" />
            <input type ="submit" name="viewRide" value="view" />
        </form><!-- comment -->
    </div>
    
 <?php
 if (isset($_POST['viewRide'])){
     $_SESSION["rideID"] =$_POST["rideID"];
     header("Location: rideDetails.php");
     $link->close();
     exit();
 }
 ?>
    
<?php
}
?>
</body>
</html><!-- comment -->