<?php

// If Session Not Logged In, Redirect To Login
if($_SESSION['loggedin'] != true)
{
    echo "<script>location.href='?page=login';</script>";		        
}

// Set Institute ID + Code
$instID = $_SESSION['inst'];
$instID = $instID + 1000;

// Set Action To Current Page
$action = $_SERVER["PHP_SELF"].'?page=dash';

// Include Dash Model & View
include ('model/dashModel.php');
include ('view/dashView.php');

?>