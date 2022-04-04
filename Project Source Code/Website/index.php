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
  
  
  
  
</head>
<body>
  
  <section class="form6 cid-t07QU6unop" id="form6-0">
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Log in</strong></h3>
            
        </div>
        <div class="row justify-content-center mt-4">
            
            <div class="col-lg-8 mx-auto mbr-form" data-form-type="formoid">
                <form method="POST" class="mbr-form form-with-styler mx-auto" data-form-title="Form Name"><input type="hidden" name="email" data-form-email="true" value="BfYcR+LtgmcCX7oVZXAIAgYvBRTvGBegrWwoqPGqg1ml7wKobSmW9jnwpgYUU67R6PehEZ8YIBzXZXHKFBHOP+tjfND96r2cKbwnAcgwWCaweHuhYID+P2Ze9YdHCgpo">
                    <div class="">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling
                            out the form!</div>
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">Oops...! some
                            problem!</div>
                    </div>
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <input type="text" name="username" placeholder="Username" data-form-field="name" class="form-control" value="">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group" >
                            <input type="password" name="password" placeholder="Password" data-form-field="email" class="form-control" value="" >
                        </div>
                        
                        <div class="col-auto mbr-section-btn align-center">
                            <button type="submit" name="submit" class="btn btn-primary display-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
  
  
  
</body>
</html>
<?php
    
        $dbname = 'users';
        $dbuser = 'root';
        $dbpass = 'DQtLufu3aXfD';
        $dbhost = 'localhost';

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");




    
    if (isset($_POST['submit'])){
        $uname=$_POST['username'];
        $upass=$_POST['password'];
             
        $query = "select * from login_credentials where username= '$uname' AND password= '$upass' limit 1";
        
        
        $result = mysqli_query($link, $query);
        
        if($row = mysqli_fetch_array($result)){
            
            if($upass==$row['password']){
                session_start();
                $_SESSION["uID"] = $row[userID];
                $_SESSION["uName"] = $row[username];
                $_SESSION["loggedIn"] = true;
                header("location:RideList.php");
                $link->close();
                exit();
            }
        }
    }
        
        
 
?>
