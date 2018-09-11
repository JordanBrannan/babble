<?php

// Reference - https://stackoverflow.com/questions/9262109/simplest-two-way-encryption-using-php

// Conect To DB
$db =db_connect::infGen();
// Decode groupid From GET
$groupid = base64_decode($_GET["groupid"]);

// Check Authorized To View Messages
$auth = $db->prepare("SELECT * FROM MessageGroup WHERE id = '".$groupid."' AND instID = '".$_SESSION["inst"]."'"); 
$auth->execute();

// If Not Authorized, Redirect To Dashboard
if ($auth->rowCount() != 1 )
{
     echo "<script>location.href='?page=dash';</script>";		        
}

// Get MessageGroup Status
$row = $auth->fetch(PDO::FETCH_OBJ);
$archived = $row->status;

// If Form POST
if($_SERVER["REQUEST_METHOD"] == "POST")
{

// Insert New Message To DB
$db =db_connect::infGen();  
$addmessage = $db->prepare("INSERT INTO Messages VALUES (NULL, AES_ENCRYPT('".$_POST['message']."','xw0o9TKgFn'), NULL, 'out', ".$groupid.", ".$_SESSION['id'].");");
$addmessage->execute();

// Update MessageGroup So Mobile App Status Is Unread
$db2 =db_connect::infGen();
$test9 = $db2->prepare("UPDATE MessageGroup SET status2 = 'unread' WHERE id = ".$groupid);
$test9->execute();

}

?>