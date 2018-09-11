<?php

// If Session Not Logged In, Redirect To Login
if($_SESSION['loggedin'] != true)
{
    echo "<script>location.href='?page=login';</script>";		        
}

// Set Action To Current Page
$action = $_SERVER["PHP_SELF"].'?page=messaging&groupid='.$_GET['groupid'];

// Include Messaging Model & View
include ('model/messagingModel.php');
include ('view/messagingView.php');

?>