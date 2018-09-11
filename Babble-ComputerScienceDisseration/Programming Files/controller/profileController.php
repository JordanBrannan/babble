<?php

// If Session Not Logged In, Redirect To Login
if($_SESSION['loggedin'] != true)
{
    echo "<script>location.href='?page=login';</script>";		        
}

// Set Action To Current Page
$action = $_SERVER["PHP_SELF"].'?page=profile&id='.$_GET['id'];

// Include Profile Model & View
include ('model/profileModel.php');
include ('view/profileView.php');


?>