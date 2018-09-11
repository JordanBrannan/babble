<?php

// Reference - https://www.w3schools.com/js/js_popup.asp

// Get Profile ID
$id = $_GET['id'];

// Get Users Row From DB
$db =db_connect::infGen();
$user = $db->prepare("SELECT * FROM Team WHERE id = '".$id."'"); 
$user->execute();

// If User Row Doesnt Exist, Redirect To Dashboard
if($user->rowCount() != 1)
{
    echo "<script>location.href='?page=dash';</script>";		        
}
// If User Row Does Exist
if($user->rowCount() == 1)
{
    // If Not Own Profile And Account is Regular, Redirect To Dashboard
    if($_GET['id'] != $_SESSION['id'] && $_SESSION['account'] == 'Regular')
        {
            echo "<script>location.href='?page=dash';</script>";		        
        }
}

// Store Users Variables            
$row = $user->fetch(PDO::FETCH_OBJ);
$name = $row->name;
$email = $row->email;
$job = $row->job;
$instid = $row->instID;

// If Institution Is Not Current One, Redirect To Dashboard
if($instid != $_SESSION['inst'])
{
    echo "<script>location.href='?page=dash';</script>";		        
}

// If Form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // If Update Details Form
    if (isset($_POST['details'])) {
        
        // Update User Row In DB
        $db =db_connect::infGen();  
        $update = $db->prepare("UPDATE Team SET name = '".$_POST['name']."', job = '".$_POST['job']."', email = '".$_POST['email']."' WHERE id = '".$_POST['id']."'");
        $update->execute();
        echo '<script type="text/javascript">alert("Details updated.");</script>';
        echo "<script>location.href='?page=profile&id=".$_GET['id']."';</script>";        
        }
    // If Password Change Form
    if (isset($_POST['password'])) {
        
        // If Passwords Match
        if($_POST['newPass'] == $_POST['confPass'])
        {
            // Hash Old And New Password
            $oldPass = $_POST['oldPass'];
            $newPass = $_POST['newPass'];
            $hashed_oldpass = md5($oldPass);
            $hashed_newpass = md5($newPass);
            
            // Check User Editing Account's Password Correct
            $db =db_connect::infGen();  
            $check = $db->prepare("SELECT * FROM Team WHERE id = '".$_SESSION['id']."' AND pass = '".$hashed_oldpass."'");
            $check->execute();
            
            // If Password Correct, Update Users Password To New One
            if($check->rowCount() == 1 )
            {
                $db=db_connect::infGen();
                $change = $db->prepare("UPDATE Team SET pass = '".$hashed_newpass."' WHERE id = '".$_POST['id']."'");
                $change->execute();
                echo '<script type="text/javascript">alert("Password changed.");</script>';
                echo "<script>location.href='?page=profile&id=".$_GET['id']."';</script>";		        
            }
            // If Password Wrong, Error Message
            else
            {
		        echo '<script type="text/javascript">alert("Incorrect password!");</script>';
            }
            
        }
        // If Passwords Dont Match, Error Message
        else
        {
            echo '<script type="text/javascript">alert("Passwords didn'."'".'t match!");</script>';
        }
    }
    
}

?>