<?php

// Reference 1 - https://stackoverflow.com/questions/2910611/php-sort-a-multidimensional-array-by-element-containing-date
// Reference 2 - https://stackoverflow.com/questions/31391037/php-refresh-just-a-part-of-the-page
// Reference 3 - https://stackoverflow.com/questions/9262109/simplest-two-way-encryption-using-php

// Require DB Connector
require ('../includes/db_connect.php');

$html = "";

// Store GET Variable
$group = $_GET['group'];

// Get All Messages From DB
$db =db_connect::infGen();  
$getmessages = $db->prepare("SELECT id, AES_DECRYPT(message,'xw0o9TKgFn') AS message, datime, outin, groupid, teamid FROM Messages WHERE groupid = ".$group.";"); 
$getmessages->execute();

// Get MessageGroup Status From DB
$db2 = db_connect::infGen();
$checkread = $db2->prepare("SELECT * FROM MessageGroup WHERE id = ".$group.";");
$checkread->execute();
$row=$checkread->fetch(PDO::FETCH_OBJ);
$status = $row -> status;

// If Status Is Unread, Update DB To Read
if($status == 'unread')
{
    $db3 = db_connect::infGen();
    $updread = $db3->prepare("UPDATE MessageGroup SET status = 'read' WHERE id = '".$group."'");
    $updread->execute();
}

// Cycle Through Messages
while($row = $getmessages->fetch(PDO::FETCH_OBJ)) {
    
    // Store Variables From Row
    $message = $row->message;
    $inout = $row->outin;
    $datime = $row->datime;
    $team = $row->teamid;
    
    // If Message Is Out (Sent From Team)
    if($inout == "out")
    {
        // Get Team Mates Details
        $db2 =db_connect::infGen();  
        $getname = $db2->prepare("SELECT * FROM Team WHERE id = ".$team.";"); 
        $getname->execute();
        // Store Variables
        $row2 = $getname->fetch(PDO::FETCH_OBJ);
        $name = $row2->name;
        
        // Get Date In Object
        $current = $datime;
        // Get Current Time
        $now = time();
        // Create Int Of Date In Object
        $old = strtotime($current);
        // Calculate Different Between Now & Objects Date
        $diff =  $now-$old;
        // Store Objects Date In New Variable
        $dateTime = $current;
        // Convert Back To Date/Time
        $dateTime = new DateTime($dateTime);
        // Format To Day/Month
        $date = $dateTime->format('d M');
        // Format To Hour/Minute
        $time = $dateTime->format('H:i');
        
        // If Difference Is Less Than 24 Hours, Store Time
         if($diff / 3600 <24){
        $daTim = $time;
        }
        // Else Store Date
        else{
            $daTim = $date;  ////format date to "2015 Aug 2015" format
        }
        
        // Add To Messages Output
        $html = $html. '
            <div class="msg msg-out">'.
            $message.'<p class="text-muted mb-0" style="text-align: right; font-size: 12px;">'.$name.' - '.$daTim.
            '</p></div>';   
    }
    
    else if($inout == "in") {
        
        // Get Date In Object
        $current = $datime;
        // Get Current Time
        $now = time();
        // Create Int Of Date In Object
        $old = strtotime($current);
        // Calculate Different Between Now & Objects Date
        $diff =  $now-$old;
        // Convert Back To Date/Time
        $old = new DateTime($current);
        // Format To Year, Month, Day
        $old = $old->format('Y M d');

        // If Difference Is Less Than 1 Minute      
        if (intval($diff/60) < 1)
        {
            $daTim = "Less than 1 minute ago";
        }
        // If Difference Is 1 Minute
        else if (intval($diff/60) == 1) 
        {
            $daTim = "1 minute ago";
        }
        // If Difference Is Less Than 60 Minutes
        else if ($diff / 60 < 60)
        {
            $daTim = intval($diff/60)." minutes ago";
        }
        // If Difference Is 1 Hour
        else if (intval($diff / 3600) == 1)
        {
            $daTim = "1 hour ago";
        }
        // If Difference Is Less Than 24 Hours
        else if ($diff / 3600 <24)
        {
            $daTim = intval($diff/3600) . " hours ago";
        }
        // If Difference Is 1 Day
        else if (intval($diff/ 86400) == 1){
            $daTim = "1 day ago";
        }
        // If Difference Is Less Than 1 Month
        else if ($diff/86400 < 30)
        {
            $daTim = intval($diff/86400) . " days ago";
        }
        // Else Give Full Date
        else
        {
            $daTim = $old;
        }

        // Add To Messages Output
        $html = $html. '
            <div class="msg msg-in" style="text-align: right;">'.
            $message.'<p class="text-muted mb-0" style="text-align: left; font-size: 12px;">'.$daTim.
            '</p></div>';   
    }
    
}

echo($html);

?>
