<?php

// Reference 1 - https://stackoverflow.com/questions/2910611/php-sort-a-multidimensional-array-by-element-containing-date
// Reference 2 - https://stackoverflow.com/questions/31391037/php-refresh-just-a-part-of-the-page
// Reference 3 - https://stackoverflow.com/questions/9262109/simplest-two-way-encryption-using-php

// Require DB Connector
require ('../includes/db_connect.php');

// Store GET Variable
$inst = $_GET['inst'];

// Initialise Arrays
$messagesLeft1 = array();
$messagesLeft2 = array();
$messagesLeft3 = array();
$html = "";

// Function To Order Messages By Date
function compare_dates($a, $b) { 
    if($a->date == $b->date) {
        return 0;
    } 
    return ($a->date > $b->date) ? -1 : 1;
}

//-- Unread Messages
$db =db_connect::infGen();  
$getgroups = $db->prepare("SELECT * FROM MessageGroup WHERE instID = ".$inst." AND status = 'unread'"); 
$getgroups->execute();

// If 1 Or More Message Groups
if($getgroups->rowCount() >= 1)
{
    // Cycle Through Groups
    while($userrow = $getgroups->fetch(PDO::FETCH_OBJ)) { 
        $temp =$db->prepare("SELECT id, groupid, AES_DECRYPT(message, 'xw0o9TKgFn') AS message, datime FROM Messages WHERE groupid = ".$userrow->id." ORDER BY id DESC LIMIT 1");
        $temp->execute();
        // Get Last Message & Store Variables Of Each Group
        while($row = $temp->fetch(PDO::FETCH_OBJ)) {
            
            $object = new stdClass();
            $object->date = $row->datime;
            $object->message = $row->message;
            $object->group = $row->groupid;
            $messagesLeft1[] = $object;
            
        }
    }
    
    // Order Unread Messages Array By Date
    usort($messagesLeft1, 'compare_dates');
    
    // For Each Object In Ordered Array
    foreach ($messagesLeft1 as $obj) 
    {
        // Get Date In Object
        $current = $obj->date;
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
        else
        {
            $daTim = $date;
        }
        
        // Convert MessageGroup ID To Base64
        $base64 = base64_encode($obj->group);
        
        // Add To Left Navbar Output
        $html = $html.'
            <li>
            <a href="?page=messaging&groupid='.$base64.'">
            <span class="menu-text" style=" width: 100%; color: #c7cfdc; margin-left: 0rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">'.$obj->message.'</br></span>
            <span class="menu-text" style=" width: 50%; text-align: right; color: #c7cfdc; margin-left: 0rem; font-size: 10px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; padding-left: 5px;">'.$daTim.'</span>
            </a>
            </li>';
    }
}
//-- End Unread Messages



//-- Read Messages
$db2 =db_connect::infGen();  
$getgroups2 = $db2->prepare("SELECT * FROM MessageGroup WHERE instID = ".$inst." AND status = 'read'"); 
$getgroups2->execute();

// If 1 Or More Message Groups
if($getgroups2->rowCount() >= 1){
    // Cycle Through Groups
    while($userrow2 = $getgroups2->fetch(PDO::FETCH_OBJ)) { 
        $temp =$db2->prepare("SELECT id, groupid, AES_DECRYPT(message, 'xw0o9TKgFn') AS message, datime FROM Messages WHERE groupid = ".$userrow2->id." ORDER BY id DESC LIMIT 1");
        $temp->execute();
        // Get Last Message & Store Variables Of Each Group
        while($row2 = $temp->fetch(PDO::FETCH_OBJ)) {
            
            $object = new stdClass();
            $object->date = $row2->datime;
            $object->message = $row2->message;
            $object->group = $row2->groupid;
            $messagesLeft2[] = $object;
            
        }
    }
    
    // Order Read Messages Array By Date
    usort($messagesLeft2, 'compare_dates');

    // For Each Object In Ordered Array
    foreach ($messagesLeft2 as $obj) 
    {
        // Get Date In Object
        $current = $obj->date;
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
        
        // Convert MessageGroup ID To Base64
        $base64 = base64_encode($obj->group);

        // Add To Left Navbar Output
        $html = $html.'
            <li>
            <a href="?page=messaging&groupid='.$base64.'">
            <span class="menu-text" style=" width: 100%; margin-left: 0rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">'.$obj->message.'</br></span>
            <span class="menu-text" style=" width: 50%; text-align: right; margin-left: 0rem; font-size: 10px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; padding-left: 5px;">'.$daTim.'</span>
            </a>
            </li>';
    }
}
// End Read Messages

// Archived Messages
$db3 =db_connect::infGen();  
$getgroups3 = $db3->prepare("SELECT * FROM MessageGroup WHERE instID = ".$inst." AND status = 'archived'"); 
$getgroups3->execute();
// If 1 Or More Message Groups
if($getgroups3->rowCount() >= 1)
{
    // New Left Navbar Heading
    $html = $html.'<li class="menu-section-heading">Archived</li>';
    // Cycle Through Groups
    while($userrow3 = $getgroups3->fetch(PDO::FETCH_OBJ)) { 
        $temp =$db2->prepare("SELECT id, groupid, AES_DECRYPT(message, 'xw0o9TKgFn') AS message, datime FROM Messages WHERE groupid = ".$userrow3->id." ORDER BY id DESC LIMIT 1");
        $temp->execute();
        // Get Last Message & Store Variables Of Each Group
        while($row3 = $temp->fetch(PDO::FETCH_OBJ)) {
            
            $object = new stdClass();
            $object->date = $row3->datime;
            $object->message = $row3->message;
            $object->group = $row3->groupid;
            $messagesLeft3[] = $object;
            
        }
    }
    
    // Order Archived Messages Array By Date
    usort($messagesLeft3, 'compare_dates');
    
    // For Each Object In Ordered Array
    foreach ($messagesLeft3 as $obj) 
    {
        // Get Date In Object
        $current = $obj->date;
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
        
        // Convert MessageGroup ID To Base64
        $base64 = base64_encode($obj->group);
        
        // Add To Left Navbar Output
        $html = $html.'
            <li>
            <a href="?page=messaging&groupid='.$base64.'">
            <span class="menu-text" style=" width: 100%; margin-left: 0rem; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">'.$obj->message.'</br></span>
            <span class="menu-text" style=" width: 50%; text-align: right; margin-left: 0rem; font-size: 10px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; padding-left: 5px;">'.$daTim.'</span>
            </a>
            </li>';
    }
}
// End Archived Messages

    
echo($html);
    
?>
