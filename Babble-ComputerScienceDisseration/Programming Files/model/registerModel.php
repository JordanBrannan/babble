<?php

// Reference - https://www.w3schools.com/js/js_popup.asp

// If Form POST
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Get All POST Varaibles
    $inst = $_POST["inst"];
    $email =  strtolower($_POST["email"]);
    $password = $_POST["password"];
    $hashed_password = md5($password);
    $confpass = $_POST["confpass"];
    
    // Check Email Isn't In Use        
    $db2 =db_connect::infGen();
    $checkEmail = $db2->prepare("SELECT * FROM Team WHERE email = '".$email."'");
    $checkEmail->execute();
    
    // If Passwords Don't Match, Error Message
    if($password != $confpass)
    {
        echo '<script type="text/javascript">alert("Passwords did not match!");</script>';
    }
    // If Email In Use, Error Message
    else if($checkEmail->rowCount() >= 1){
        echo '<script type="text/javascript">alert("Email already in use!");</script>';
    }
    // Else Insert Into DB
    else
    {
        // Insert New Institute
        $db =db_connect::infGen();
        $newTeam = $db->prepare("INSERT INTO Institute VALUES (NULL, '".$inst."')");
        $newTeam->execute();
        $getTeam = $db->prepare("SELECT * FROM Institute WHERE id = LAST_INSERT_ID()");
		$getTeam->execute();
		$row = $getTeam->fetch(PDO::FETCH_OBJ);
		$instID = $row->id;
		
		// Insert New Team Mate
	    $newTeamMate = $db->prepare("INSERT INTO Team VALUES(NULL, 'NEW', 'NEW', '".$email."', '".$hashed_password."', ".$instID.", 'Owner')");
		$newTeamMate->execute();
		$getTeamMate = $db->prepare("SELECT * FROM Team WHERE id = LAST_INSERT_ID()");
		$getTeamMate->execute();
		$row2= $getTeamMate->fetch(PDO::FETCH_OBJ);
		
		// Set Session Variables
        $_SESSION['account'] = $row2->account;
        $_SESSION['instName'] = $inst;
        $_SESSION['id'] = $row2->id;
        $_SESSION['loggedin'] = true;
        $_SESSION['inst'] = $instID;
		 
		// Redirect To Dashboard
        echo "<script>location.href='?page=dash';</script>";		        
                
    }
	        
}

?>