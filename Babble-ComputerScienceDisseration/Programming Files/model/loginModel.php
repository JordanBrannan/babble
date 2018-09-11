<?php

// Reference - https://www.w3schools.com/js/js_popup.asp

// If Form POST
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Lowercase Email
    $email =  strtolower($_POST["email"]);
    
    // Hash Password
    $password = $_POST["password"];
    $hashed_password = md5($password);
	
	// Connect To DB And Check Users Details Correct
	$db =db_connect::infGen();
    $login = $db->prepare("SELECT * FROM Team WHERE email = '".$email."' AND pass = '".$hashed_password."'"); 
    $login->execute();
    
    // If Correct
    if ($login->rowCount() == 1 )
	{
	    // Get Users Row
		$row = $login->fetch(PDO::FETCH_OBJ);
		$inst = $row->instID;
		$id = $row->id;
		$account = $row->account;
		
        $db =db_connect::infGen();
        $instit = $db->prepare("SELECT * FROM Institute WHERE id = '".$inst."'"); 
        $instit->execute();
        $row2 = $instit->fetch(PDO::FETCH_OBJ);
        $instName = $row2->name;
        
        // Set Session Variables
        $_SESSION['account'] = $account;
        $_SESSION['instName'] = $instName;
        $_SESSION['id'] = $id;
	    $_SESSION['loggedin'] = true;
	    $_SESSION['inst'] = $inst;
	    
	    // Redirect To Dashboard
        echo "<script>location.href='?page=dash';</script>";		        
	}
	// Else Not Correct
	else
	{
	    // Error Alert
	    echo '<script type="text/javascript">alert("Invalid login details!");</script>';
	}
	
}


?>