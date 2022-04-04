<?php 
 $dbname = 'users';
        $dbuser = 'root';
        $dbpass = 'DQtLufu3aXfD';
        $dbhost = 'localhost';

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");


session_start();
// delete all of the session variables
$_SESSION = array();
session_destroy();
	
// redirect the user back to the login page
header("Location: index.php");
exit();

?>

