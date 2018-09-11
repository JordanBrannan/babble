<?php

// If Session Logged In, Redirect To Dashboard
if($_SESSION['loggedin'] == true)
{
    echo "<script>location.href='?page=dash';</script>";		        
}
// Else Continue To Register Page
else{
// Set Action To Current Page
$action = $_SERVER["PHP_SELF"].'?page=register';

// Include Register Model & View
include ('model/registerModel.php');
include ('view/registerView.php');

}

?>