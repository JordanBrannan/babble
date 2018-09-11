<?php

// Start session
session_start();

// Require db connector
require ('assets/includes/db_connect.php');

$html = "";

// If no page is set, default to home, else get the page that user is on
if (!isset($_GET['page'])) 
	{
		$page_id = 'home'; 
	} 
else{
	$page_id = $_GET['page'];
    }
    

//Switch statement (Changes controller depending on page variable)
switch ($page_id) 
    {
	    case 'home' :
	    include '404.html';     
	    break;
	    case 'privacy' :
	    include 'privacy.php';
	    break;
	    case 'terms' :
	    include 'terms.php';
	    break;
	    case 'register' :
	    include 'controller/registerController.php';
	    break;
	    case 'login' :
	    include 'controller/loginController.php';
	    break;
	    case 'dash' :
	    include 'controller/dashController.php';
	    break;
	    case 'messaging' :
	    include 'controller/messagingController.php';
	    break;
	    case 'profile' :
	    include 'controller/profileController.php';
	    break;
	    case 'logout' :
	    include 'assets/templates/logout.php';
	    break;
	    default :
	    include '404.html';
    }

// Echo content onto page
echo $html;

?>
