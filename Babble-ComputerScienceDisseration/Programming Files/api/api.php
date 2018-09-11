<?php

// Reference - http://www.nikola-breznjak.com/blog/javascript/ionic3/posting-data-ionic-3-app-php-server/
// Reference 2 - https://stackoverflow.com/questions/2910611/php-sort-a-multidimensional-array-by-element-containing-date

// Require DB Connector
require ('../assets/includes/db_connect.php');

// Cache For One Day
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    header("Access-Control-Allow-Headers:        
            {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

// Get Data Sent Via API
$postdata = file_get_contents("php://input");

// If Variable Contains Data
if (isset($postdata)) {

    // Store As Variable
	$request = json_decode($postdata);
	// Store Action Of Object
	$action = $request->action;
	
	// If Action Is Add New, Insert New User Into DB
    if($action == 'addNew')
    {
        $db =db_connect::infGen();
        $test = $db->prepare("INSERT INTO User VALUES (NULL)"); 
        $test->execute();
        
        $test2 = $db->prepare("SELECT * FROM User ORDER BY id DESC LIMIT 1");
        $test2->execute();
		$row = $test2->fetch(PDO::FETCH_OBJ);
				
		$id = $row->id;
        $id2 = trim($id, '"');
        
        // For Debugging Purposes
        echo json_encode($id2);
    }
    // If Action is New Mess, Insert New Message Into DB
    if($action == 'newMess'){
        
        // Get Object Variables    
        $message = $request->message;
        $group = $request->group;
        
        // Add New Message
        $db =db_connect::infGen();
        $test4 = $db->prepare("INSERT INTO Messages VALUES (NULL, AES_ENCRYPT('".$message."','xw0o9TKgFn'), NULL, 'in', '".$group."', NULL)");
        $test4->execute();
        
        // Update MessageGroup To Unread For Web App
        $db =db_connect::infGen();
        $test9 = $db->prepare("UPDATE MessageGroup SET status = 'unread' WHERE id = ".$group);
        $test9->execute();
        
        // For Debugging Purposes
        echo json_encode("test");
    }
    // If Action Is New Conv, Insert New Conversation Into DB
    if($action == 'newConv'){
        
        // Store Object Variables
        $instID = $request->code;
        $instID = $instID - 1000;
        $id = $request->id;
        $id = trim($id, '"');
        
        // Check Institute Exits
        $db =db_connect::infGen();
        $test6 = $db->prepare("SELECT * FROM Institute WHERE id = ".$instID);
        $test6->execute();
        
        // If Exists, Insert Into DB
        if ($test6->rowCount() == 1 )
	    {
	        $test7 = $db->prepare("INSERT INTO MessageGroup VALUES (NULL, '".$instID."', '".$id."', 'unread', 'unread')");
	        $test7->execute();
	        $response = "true";
	    }
	    // Else Return Response To Mobile App
		else{
	        $response = "false";
            echo json_encode($response);
		}
    }
    // If Action Is Archive, Update MessageGroup Status in DB
    if($action == 'archive'){
        
        // Store Object Variables
        $convoID = $request->group;
        
        // Update DB
        $db =db_connect::infGen();
        $test10 = $db->prepare("UPDATE MessageGroup SET status = 'archived', status2 = 'archived' WHERE id = ".$convoID);
        $test10->execute();
    }
    // If Action is Get Mess, Get Last Message From All MessageGroups
    if($action == 'getMess')
    {
        // Store Object Variables
        $id = $request->id;
        $id = trim($id, '"');
        
        // Get All MessageGroups
        $db =db_connect::infGen();  
        $test5 = $db->prepare("SELECT * FROM MessageGroup WHERE userID = ".$id." AND status IN ('read', 'unread')"); 
        $test5->execute();
        
        // Initialise 3 Arrays
        $messages2 = array();
        $messages3 = array();
        $messages4 = array();
        
        // Cycle Through Rows
        while($userrow = $test5->fetch(PDO::FETCH_OBJ)) {
            
            // Store Row Variables
            $status2 = $userrow->status2;
            $groupid = $userrow->id;
            $inst = $userrow->instID;
            
            // Get Institution Name
            $temp2 = $db->prepare("SELECT * FROM Institute WHERE id = ".$inst);
            $temp2->execute();
            $userrow3 = $temp2->fetch(PDO::FETCH_OBJ);
            $instName = $userrow3->name;
            
            // Get Last Message From MessageGroup
            $tempMess =$db->prepare("SELECT id, AES_DECRYPT(message, 'xw0o9TKgFn') AS message, datime FROM Messages WHERE groupid = ".$groupid." ORDER BY id DESC LIMIT 1");
            $tempMess->execute();
            
            // If Message In MessageGroup
            if($tempMess->rowCount() == 1)
            {
                // Store Last Message
                $userrow2 = $tempMess->fetch(PDO::FETCH_OBJ);
                $message2 = $userrow2->message;
                $datime = $userrow2->datime;
                
                // Get Date In Row
                $current = $datime;
                // Get Current Time
                $now = time();
                // Create Int Of Date In Row
                $old = strtotime($current);
                // Calculate Different Between Now & Rows Date
                $diff =  $now-$old;
                // Store Rows Date In New Variable
                $dateTime = $current;
                // Convert Back To Date/Time
                $dateTime = new DateTime($dateTime);
                // Format To Day/Month
                $date = $dateTime->format('d M');
                // Format To Hour/Minute
                $time = $dateTime->format('H:i');
                // Store Variable Of Original Date For Object
                $dateObj = $datime;
                
                // If Difference Is Less Than 24 Hours, Store Time
                if ($diff / 3600 <24){
                    $dt = $time;
                }
                // Else Store Date
                else{
                    $dt = $date;
                }
                    
            }
            // Else No Messages
            else{
                // Create Date For Tomorrow And Basic Message
                
                $datetime = new DateTime('tomorrow');
                $datetime->format('Y-m-d H:i:s');

                
                $datime = $datetime;
                $message2 = "No Messages...";
                $dt = '';
            }
            // If Status Is Unread, Assign Specific Variables To Object
            if($status2 == 'unread'){
                
                $object2 = new stdClass();
                $object2->name = $instName;
                $object2->time = $dt;
                $object2->date = $datime;
                $object2->id = $groupid;
                $object2->messages = $message2;
                $object2->colour = '000000';
                $messages2[] = $object2;
                
                
            }
            // Else, These Variables
            else{
                $object3 = new stdClass();
                $object3->name = $instName;
                $object3->time = $dt;
                $object3->date = $datime;
                $object3->id = $groupid;
                $object3->messages = $message2;
                $object3->colour = '999999';
                $messages3[] = $object3;
                    
            }
                
        }
            
        // Function To Compare Dates   
        function compare_dates($a, $b) { 
            if($a->date == $b->date) {
                return 0;
            } 
            return ($a->date > $b->date) ? -1 : 1;
        } 
        
        // Sort Unread & Read Arrays
        usort($messages2, 'compare_dates');
        usort($messages3, 'compare_dates');
        
        // Cycle Through Unread Messages And Add To Third Array
        foreach ($messages2 as $obj) {
                
        $object4 = new stdClass();
        $object4->name = $obj->name;
        $object4->time = $obj->time;
        $object4->date = $obj->date;
        $object4->id = $obj->id;
        $object4->messages = $obj->messages;
        $object4->colour = $obj->colour;
        $messages4[] = $object4;
        }
        
        // Cycle Through Read Messages And Add To Third Array
        foreach ($messages3 as $obj) {
        $object4 = new stdClass();
        $object4->name = $obj->name;
        $object4->time = $obj->time;
        $object4->date = $obj->date;
        $object4->id = $obj->id;
        $object4->messages = $obj->messages;
        $object4->colour = $obj->colour;
        $messages4[] = $object4;
        }
        
        // Respond With Third Array
        echo json_encode($messages4);
    }
    // If Acction Is Read, Update MessageGroup To Read By Mobile App
    if($action == 'read')
    {
        $group = $request->group;
        $db =db_connect::infGen();
        $test8 = $db->prepare("UPDATE MessageGroup SET status2 = 'read' WHERE id = ".$group.";"); 
        $test8->execute();
        
        // For Debugging Purposes
        echo "Test response!";
    }
    // If Action is Get All, Get All Messages And Return
    if($action == 'getAll')
    {
        $group = $request->group;
        
        $db =db_connect::infGen();
        $test3 = $db->prepare("SELECT id, AES_DECRYPT(message,'xw0o9TKgFn') AS message, datime, outin, groupid, teamid FROM Messages WHERE groupid = ".$group.";"); 
        $test3->execute();
        
        // Initialise Array
        $messages = array();
        
        // Cycle Throuhg Each Row Of Messages
        while($userrow = $test3->fetch(PDO::FETCH_OBJ)) { 
            
            // Store Variables In New Object
            $message = $userrow->message;
            $object = new stdClass();
            $object->messages = $message;
            $inout = $userrow->outin;
            
            // If Message Is In To Web App, Append This To Object
            if($inout == 'in')
            {
                $align = 'right';
                $colour = '0095ff';
                $text = 'white';
            }
            // Else If Out From Web App, Append This
            else if($inout == 'out')
            {
                $align = 'left';
                $colour = 'f2f2f2';
                $text = 'black';
            }
                
            // Get Date In Row
            $olddate = $userrow->datime;
            // Get Current Time
            $now = time();
            // Create Int Of Date In Row
            $old = strtotime( $olddate);
            // Calculate Different Between Now & Rows Date
            $diff =  $now-$old;
            // Convert Back To Date/Time
            $old = new DateTime($olddate);
            // Format To Year/Month/Date
            $old = $old->format('Y M d');

            // If Difference Is Less Than 1 Minute
            if ($diff /60 <1)
            {
                $dt = "< 1 minute ago";
            }
            // If Difference Is 1 Minute
            else if (intval($diff/60) == 1) 
            {
                $dt = "1 minute ago";
            }
            // If Difference Is Less Than 1 Hour
            else if ($diff / 60 < 60)
            {
                $dt = intval($diff/60)." minutes ago";
            }
            // If Difference Is 1 Hour
            else if (intval($diff / 3600) == 1)
            {
                $dt = "1 hour ago";
            }
            // If Difference Is Less Than 1 Day
            else if ($diff / 3600 <24)
            {
                $dt = intval($diff/3600) . " hours ago";
            }
            // If Difference Is 1 Day
            else if (intval($diff / 86400) == 1)
            {
                $dt = "1 day ago";
            }
            // If Difference Is Less Than 1 Month
            else if ($diff/86400 < 30)
            {
                $dt = intval($diff/86400) . " days ago";
            }
            // Else Full Format
            else
            {
                $dt = $old;  ////format date to "2015 Aug 2015" format
            }
            
            // Add Items To Object Array
            $object->time = $dt;
            $object->align = $align;
            $object->colour = $colour;
            $object->text = $text;
            $messages[] = $object;
            
        }
        // Respond With Messages Object Array    
        echo json_encode($messages);
    }
		
}
// If Fails
else {
    echo "Error!";
}
?>
