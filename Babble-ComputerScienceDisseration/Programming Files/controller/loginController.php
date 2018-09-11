<?php

// Set Action To Current Page
$action = $_SERVER["PHP_SELF"].'?page=login';

// Include Login Model & View
include ('model/loginModel.php');
include ('view/loginView.php');


?>