<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
include './user_validation/login_validation.php';
?>
<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.2.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo6.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>F.L.O.A.T. Log in</title>
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/formstyler/jquery.formstyler.css">
  <link rel="stylesheet" href="assets/formstyler/jquery.formstyler.theme.css">
  <link rel="stylesheet" href="assets/datepicker/jquery.datetimepicker.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <link rel="stylesheet" href="./navStyles.css"/>
  
  
</head>
<body>
  <?php
  include "navigationBar.php";
  ?>
  <section class="form6 cid-t07QU6unop" id="form6-0">
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Enter a ride</strong></h3>
            
        </div>
        <div class="row justify-content-center mt-4">
            
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form method="POST" class="mbr-form form-with-styler mx-auto" action="RideRegister.php" enctype="multipart/form-data">
                    
                    <div class="dragArea row">
                        
                        <label class="col-sm-12"> Type in Location</label>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <input type="text" name="rideLocation" placeholder="Location" class="form-control"/>
                        </div>
                        
                        <label class="col-sm-12"> a Enter Date of Ride</label>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <input type="date" name="dateOfRide" class="form-control"/>
                        </div>
                        
                        <label class="col-sm-12"> Upload Ride CSV file</label>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <input type="file" id="file-upload" name="file" class="form-control"/>
                        </div>
                        
                        
                        <div class="col-auto mbr-section-btn align-center">
                            <button type="submit" name="register" class="btn btn-primary display-4">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
  
  
  
</body>
</html>
<?php
if(isset($_POST['register'])){
    $file = $_FILES['file'];
    
    $rideDate = $_POST['dateOfRide'];
    $rideLocation = $_POST['rideLocation'];
    
    $fileName =$_FILES['file']['name'];
    $fileTmpName =$_FILES['file']['tmp_name'];
    $fileSize =$_FILES['file']['size'];
    $fileError =$_FILES['file']['error'];
    $fileType =$_FILES['file']['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = ['pdf', 'csv'];
    
    if (in_array($fileActualExt, $allowed)) {
        
        if ($fileError === 0){
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'RIDES/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: testupload.php?uploadsuccess?$fileDestination");
                
                include 'databaseRidesConnect.php';
                #INSERT INTO `rideCatalog` (`location`, `rideDate`, `startTime`, `endTime`, `duration`, `csv`, `registeredByID`) VALUES ('yuh', '2022-04-19', '22:25:23', '12:25:39', '00:43:04', '', '')
              
                
                
                
                
                
            } else {
                echo("your file is too big");
            }
        }else {
           echo("there was an error uploading your file!");
        }
    }
    else{
        echo("you can't upload files of this type!");
        $yuh = date("Y-m-d");
        $yuhStartTime = date_create('04:10:58');
        $yuhEndTime = date_create('06:9:59');
        $yuhdate= date_create($yuh);
        $yuh2date= date_create($rideDate);
        $timeInterval = date_diff($yuhStartTime, $yuhEndTime);
        
        //echo($yuhdate);
        echo("date entered");
        #echo($yuh2date);
        $minutes = $timeInterval->days * 24 * 60;
        $minutes += $timeInterval->h * 60;
        $minutes += $timeInterval->i;
        $diff=date_diff($yuhdate, $yuh2date);
        echo $diff->format("%R%a days");
        echo $minutes.' yuh minutes';
        
        
        //extracting time from file
        $fileStart;
        $fileEnde;
        $fileItems = 0;
        if (($open = fopen('testmap.csv', "r")) !== FALSE) {
            while(list($currentTime) = fgetcsv($open,1024,',')) { 
                if($currentTime != 'Current Time'){
                $mapTimes[$fileItems] = $currentTime;  
                $fileItems += 1;
                }
            }
        }
        $yuhStartTime = date_create($mapTimes[0]);
        $yuhEndTime = date_create(end($mapTimes));
        $timeInterval = date_diff($yuhStartTime, $yuhEndTime);
        $minutes = $timeInterval->days * 24 * 60;
        $minutes += $timeInterval->h * 60;
        $minutes += $timeInterval->i;
        $timeFromMap = $timeInterval->h .':'.$timeInterval->i.":".$timeInterval->s;
        echo ($timeFromMap);
        echo $minutes.' yuh minutes';
    }
}
?>
