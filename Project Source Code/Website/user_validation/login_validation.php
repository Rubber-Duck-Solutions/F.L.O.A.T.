<?php
session_start();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    
} else {
    header("Location: error.html");
}
 
?>