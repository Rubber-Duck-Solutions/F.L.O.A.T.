
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F.L.O.A.T Log in</title>
    <link rel="stylesheet" href="./styles.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="bottom-padding">
   
    </div>
    <div class="
                    flex
                    flex-1">
        <div class="about-me__info--container">
            
            <form method="POST">
		<div class="form-input">
                    <input type="text" name="username" placeholder="Enter User Name"/>	
		</div>
           
		<div class="form-input">
                    <input type="password" name="password" placeholder="password"/>
		</div>
                    <input type="Submit" name="submit" />
            </form>
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
                header("location:rideList.php");
                $link->close();
                exit();
            }
        }
    }
        
        
 
?>
