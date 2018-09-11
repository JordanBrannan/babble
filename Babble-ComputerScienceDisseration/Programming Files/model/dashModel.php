<?php

// Reference - https://www.w3schools.com/js/js_popup.asp

// If Form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // If Delete Button, Remove From DB
    if (isset($_POST['delete'])) {
            
        $db =db_connect::infGen();  
        $delete = $db->prepare("DELETE FROM Team WHERE id = '".$_POST['id']."'");
        $delete->execute();
        echo "<script>location.href='?page=dash';</script>";		        
            
    }
    
    // If Promote Button, Update Account Type In DB
    if (isset($_POST['promote'])) {
        
        $db =db_connect::infGen();  
        $promote = $db->prepare("UPDATE Team SET account = 'Admin' WHERE id = '".$_POST['id']."'");
        $promote->execute();
        echo "<script>location.href='?page=dash';</script>";		        
            
    }
    
    // If Demote Button, Update Account Type In DB
    if (isset($_POST['demote'])) {
        
        $db =db_connect::infGen();  
        $demote = $db->prepare("UPDATE Team SET account = 'Regular' WHERE id = '".$_POST['id']."'");
        $demote->execute();
        echo "<script>location.href='?page=dash';</script>";		        
            
    }
    
    // If New User
    if (isset($_POST['new'])) {
            
        $db = db_connect::infGen();
        $emailCheck = $db->prepare("SELECT * FROM Team WHERE email = '".$_POST['email']."'");
        $emailCheck->execute();
        
        // If Email Is In Use, Error Alert
        if($emailCheck->rowCount() == 1){
                echo '<script type="text/javascript">alert("E-mail already in use!");</script>';
        }
        
        // Else Inser New Row Into DB
        else{
                
        $db =db_connect::infGen();  
        $addNew = $db->prepare("INSERT INTO Team VALUES (NULL, '".$_POST['name']."', '".$_POST['job']."', '".$_POST['email']."', 'password', '".$_SESSION['inst']."', 'Regular');");
        $addNew->execute();
        echo "<script>location.href='?page=dash';</script>";		        

        }
            
    }
    
}

// Dashboard Analytics

//-- Messages In

// Get Last Weeks Results
$db2 =db_connect::infGen();  
$week1in = $db2->prepare("SELECT * FROM Messages m INNER JOIN MessageGroup mg ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND outin = 'in' AND m.datime >= (NOW() - INTERVAL 1 WEEK)");
$week1in->execute();
$in1 = $week1in->rowCount();

// Get Week Before Lasts Results        
$db3 =db_connect::infGen();  
$week2in = $db3->prepare("SELECT * FROM Messages m INNER JOIN MessageGroup mg ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND outin = 'in' AND m.datime >= (NOW() - INTERVAL 2 WEEK) AND m.datime < (NOW() - INTERVAL 1 WEEK)");
$week2in->execute();
$in2 = $week2in->rowCount();

$in3 = $in2;

// If No Results Week Before, Set To Divide By 1
if($in3 == 0)
{
    $in3 = 1;
}

// Get Difference Between Week 1 & 2
$indiff = (($in1 - $in2)/$in3)*100;
$indiff = round($indiff);

//-- End  Messages In

//-- Mesages Out

//Get Last Weeks Results
$db4 =db_connect::infGen();  
$week1out = $db4->prepare("SELECT * FROM Messages m INNER JOIN MessageGroup mg ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND outin = 'out' AND m.datime >= (NOW() - INTERVAL 1 WEEK)");
$week1out->execute();
$outCount1 = $week1out->rowCount();
$out1 = (int)$outCount1;

// Get Week Before Lasts Results
$db5 =db_connect::infGen();  
$week2out = $db5->prepare("SELECT * FROM Messages m INNER JOIN MessageGroup mg ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND outin = 'out' AND m.datime >= (NOW() - INTERVAL 2 WEEK) AND m.datime < (NOW() - INTERVAL 1 WEEK)");
$week2out->execute();
$out2 = $week2out->rowCount();

$out3 = $out2;

// If No Results Week Before Set To Divide By 1
if($out3 == 0)
{
    $out3 = 1;
}

// Get Difference Between Week 1 & 2
$outdiff = (($out1 - $out2)/$out3)*100;
$outdiff = round($outdiff);

//-- End Messages Out

//-- Total Conversations

// Get Last Months Results
$db6 =db_connect::infGen();  
$month1convo = $db6->prepare("SELECT * FROM MessageGroup mg INNER JOIN Messages m ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND m.datime >= (NOW() - INTERVAL 1 MONTH) GROUP BY mg.id");
$month1convo->execute();
$convo1 = $month1convo->rowCount();

// Get Month Before Lasts Results
$db7 =db_connect::infGen();  
$month2convo = $db7->prepare("SELECT * FROM MessageGroup mg INNER JOIN Messages m ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND m.datime >= (NOW() - INTERVAL 2 MONTH) AND m.datime < (NOW() - INTERVAL 1 MONTH) GROUP BY mg.id)");
$month2convo->execute();
$convo2 = $month2convo->rowCount();

$convo3 = $convo2;

// If No Results Month Before Set To Divide By 1
if($convo3 == 0)
{
    $convo3 = 1;
}

// Get Difference Between Month 1 & 2
$convodiff = (($convo1 - $convo2)/$convo3)*100;
$convodiff = round($convodiff);

//-- End Total Conversations

//-- Total Messages

// Get Last Days Results
$db8 =db_connect::infGen();  
$day1total = $db8->prepare("SELECT * FROM Messages m INNER JOIN MessageGroup mg ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND m.datime >= (NOW() - INTERVAL 1 DAY)");
$day1total->execute();
$day1 = $day1total->rowCount();

// Get Day Before Lasts Results
$db9 =db_connect::infGen();  
$day2total = $db9->prepare("SELECT * FROM Messages m INNER JOIN MessageGroup mg ON mg.id = m.groupid WHERE mg.instID = ".$_SESSION['inst']." AND m.datime >= (NOW() - INTERVAL 2 DAY) AND m.datime < (NOW() - INTERVAL 1 DAY)");
$day2total->execute();
$day2 = $day2total->rowCount();

$day3 = $day2;

// If No results Day Before Set To Divide By 1
if ($day3 == 0)
{
    $day3 = 1;
}

// Get Difference Between Day 1 & 2
$daydiff = (($day1 - $day2)/$day3)*100;
$daydiff = round($daydiff);

//-- End Total Messages

?>