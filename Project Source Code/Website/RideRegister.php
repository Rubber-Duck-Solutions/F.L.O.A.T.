<?php
include './user_validation/login_validation.php';
?>
<!DOCTYPE html>
<html  >
<head>
<?php include './head.php'; ?>
  <title>F.L.O.A.T. Ride Register</title>
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
                        <?php
                        $currentDate = date("Y-m-d");
                        ?>
                        <label class="col-sm-12"> Enter Date of Ride</label>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <input type="date" name="dateOfRide" max="<?=$currentDate?>" class="form-control"/>
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
    $enteredDate= date_create($rideDate);

    if (in_array($fileActualExt, $allowed)) {
        
        if ($fileError === 0){
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'RIDES/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                    

                $fileDestination= './'.$fileDestination;
                $fileItems = 0;
                if (($open = fopen($fileDestination, "r")) !== FALSE) {
                    while(list($currentTime) = fgetcsv($open,1024,',')) { 
                        if($currentTime != 'Current Time'){
                            $mapTimes[$fileItems] = $currentTime;  
                            $fileItems += 1;
                        }
                    }          
                }
                $rideStartTime = date_create($mapTimes[0]);
                $rideEndTime = date_create(end($mapTimes));
                $timeInterval = date_diff($rideStartTime, $rideEndTime);
                $timeFromMap = $timeInterval->h .':'.$timeInterval->i.":".$timeInterval->s;
                    
                include 'databaseRidesConnect.php';
                    
                $enteredDate = $enteredDate->format('Y-m-d');
                $rideStartTime = $rideStartTime->format('H:i:s');
                $rideEndTime = $rideEndTime->format('H:i:s');
                $dbQuery = "INSERT INTO `rideCatalog` (`location`, `rideDate`, `startTime`, `endTime`, `duration`, `csv`, `registeredByID`) VALUES ('$rideLocation', '$enteredDate', '$rideStartTime', '$rideEndTime', '$timeFromMap', '$fileDestination', '$_SESSION[uID]')";
                 $link->query($dbQuery);
                echo('<div data-form-alert="" class="alert alert-success col-12">Ride entered succesfully!</div>');
                
                
                
                
                
            } else {
                 echo ('<div data-form-alert-danger="" class="alert alert-danger col-12">Your file is too big.</div>');
            }
        }else {
            echo ('<div data-form-alert-danger="" class="alert alert-danger col-12">There was an error uploading your file.</div>');
        }
    }
    else{
        echo ('<div data-form-alert-danger="" class="alert alert-danger col-12">You can\'t upload files of this type!</div>');
    }
}
?>
