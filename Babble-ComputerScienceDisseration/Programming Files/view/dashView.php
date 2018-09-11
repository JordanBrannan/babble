<?php

// Reference - https://themeforest.net/item/luxury-responsive-bootstrap-4-admin-template/20881509
// Reference 2 - https://stackoverflow.com/questions/31391037/php-refresh-just-a-part-of-the-page

require('assets/templates/header.php');

$html=$html.'
  <!-- Theme Customiser -->
  <link rel="stylesheet" href="assets/examples/css/theme-customizer.css">
  <script src="assets/examples/js/theme-customizer.js"></script>
  <!-- End Theme Customiser -->
  
  <!-- Core Plugins -->
  <link rel="stylesheet" href="assets/vendor/css/hamburgers.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/sweetalert/dist/sweetalert.css">
  <!-- End Core Plugins -->
  
  <!-- Site Wide Styles -->
  <link rel="stylesheet" href="assets/vendor/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/site.css">
  <!-- End Site Wide Styles -->
  
  <!-- Plugins For Current Page -->
  <link rel="stylesheet" href="assets/vendor/bower_components/chartist/dist/chartist.min.css">
  <link rel="stylesheet" href="assets/vendor/jvectormap/jquery-jvectormap.css">
  <!-- End Plugins For Current Page -->

  <!-- Current Page Styles -->
  <link rel="stylesheet" href="assets/examples/css/dashboards/dashboard.v1.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600">
  <!-- End Current Page Styles -->
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="assets/vendor/bower_components/breakpoints.js/dist/breakpoints.min.js"></script>
<script>Breakpoints({xs: {min:0,max:575},sm: {min:576,max:767},md: {min:768,max:991},lg: {min:992,max:1199},xl: {min:1200,max:Infinity}});</script>
</head>

<!-- Begin Body -->
<body class="menubar-left menubar-dark dashboard dashboard-v1">
  <div class="site-wrapper">
  
    <!-- Left Navbar -->
    <aside class="site-menubar">
      <div class="site-menubar-inner">
        <ul class="site-menu">

          <!-- MAIN NAVIGATION SECTION -->';
          
// Require Navbar Template
require ("assets/templates/nav.php");
          
          $html = $html.'
          <!-- Ajax/JS Script For Conversations On Navbar -->
          <script type="text/javascript">
             $(document).ready(function() {
             $("#Status").load("assets/ajax/ajaxNav.php?inst='.$_SESSION['inst'].'");
               var auto_refresh = setInterval(
               function ()
               {
                   $("#Status").load("assets/ajax/ajaxNav.php?inst='.$_SESSION['inst'].'");
               }, 1000); 
             });
          </script>
          <div id="Status"></div>
          <!-- End Ajax/JS Script -->
          
        </ul>
      </div>
    </aside>
    <!-- End Left Navbar -->

    <!-- Main Dashboard Content -->
    <main class="site-main">
    
      <!-- Dashboard Page Header -->
      <header class="site-header">
        <div class="jumbotron jumbotron-fluid">
          <div class="jumbotron-text">
            <h4 class="text-primary">'.$_SESSION['instName'].' - '.$instID.'</h4>
            <small class="font-italic text-muted">Here you may see conversation analytics. New users are able to contact you by entering your institution code within the Babble App. Your code can be seen above.</small>
          </div><!-- /.jumbotron-text -->
        </div><!-- /.jumbotron -->
        
        <div class="breadcrumb">
          <ol class="breadcrumb-tree">
            <li class="breadcrumb-item">
              <a href="'.$action.'">
                <span class="zmdi zmdi-home mr-1"></span>
                <span>Home</span>
              </a>
            </li>
            <li class="breadcrumb-item active"><a href="'.$action.'">Dashboard</a></li>
          </ol>
        </div>
      </header>
      <!-- End Dashboard Page Header -->
    
      <!-- Dashboard Analytics/Team -->
      <div class="site-content">
      
         <!-- Top Row of Cards -->
         <div class="row">
         
           <!-- Conversations Card -->
           <div class="col-lg-3 col-sm-6">
             <div class="card">
               <header class="card-header">
                 <h6 class="card-heading">Conversations</h6>
               </header>
               <div class="card-body d-flex px-3">
                  <div class="mr-auto text-primary">
                      <h5><span data-plugin="counterUp">'.$convo1.'</span></h5>
                      <span>New Conversations</span>
                  </div>
                  <div>
                     <a href="#" class="btn btn-sm btn-primary">Monthly</a>
                     <div class="mt-3 text-center">
                        <span class="mr-2">'.$convodiff.'% </span>';

// If Percentage Difference is possitive, Blue Up Arrow, Else Red Down Arrow    
if($convodiff >= 0){
    $html = $html.'<i class="fa fa-long-arrow-up text-primary"></i>';
}
else{
    $html = $html.'<i class="fa fa-long-arrow-down text-danger"></i>';
}
                  
$html = $html.'
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <!-- End Conversations Card -->
          
          <!-- Messages In Card -->
          <div class="col-lg-3 col-sm-6">
             <div class="card">
                <header class="card-header">
                   <h6 class="card-heading">Messages In</h6>
                </header>
                <div class="card-body d-flex px-3">
                   <div class="mr-auto text-primary">
                      <h5><span data-plugin="counterUp">'.$in1.'</span></h5>
                      <span>Messages Received</span>
                   </div>
                   <div>
                      <a href="#" class="btn btn-sm btn-warning">Weekly</a>
                      <div class="mt-3 text-center">
                         <span class="mr-2">'.$indiff.'% </span>';
                     
// If Percentage Difference is possitive, Blue Up Arrow, Else Red Down Arrow
if($indiff >= 0){
    $html = $html.'<i class="fa fa-long-arrow-up text-primary"></i>';
}
else{
    $html = $html.'<i class="fa fa-long-arrow-down text-danger"></i>';
}

$html = $html.'
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <!-- End Messages In Card -->
          
          <!-- Messages Out Card -->
          <div class="col-lg-3 col-sm-6">
             <div class="card">
                <header class="card-header">
                   <h6 class="card-heading">Messages Out</h6>
                </header>
                <div class="card-body d-flex px-3">
                   <div class="mr-auto text-primary">
                      <h5><span data-plugin="counterUp">'.$out1.'</span></h5>
                      <span>Messages Sent</span>
                   </div>
                   <div>
                      <a href="#" class="btn btn-sm btn-warning">Weekly</a>
                      <div class="mt-3 text-center">
                         <span class="mr-2">'.$outdiff.'% </span>';
                
// If Percentage Difference is possitive, Blue Up Arrow, Else Red Down Arrow
if($outdiff >= 0){
    $html = $html.'<i class="fa fa-long-arrow-up text-primary"></i>';
}
else{
    $html = $html.'<i class="fa fa-long-arrow-down text-danger"></i>';
}
                  
$html = $html.'
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <!-- End Messages Out Card -->
          
          <!-- Messages Today Card -->
          <div class="col-lg-3 col-sm-6">
             <div class="card">
                <header class="card-header">
                   <h5 class="card-heading">Messages Today</h5>
                </header>
                <div class="card-body d-flex px-3">
                   <div class="mr-auto text-primary">
                      <h5><span data-plugin="counterUp">'.$day1.'</span></h5>
                      <span>Total Messages</span>
                   </div>
                   <div>
                      <a href="#" class="btn btn-sm btn-danger">Today</a>
                      <div class="mt-3 text-center">
                         <span class="mr-2">'.$daydiff.'% </span>';

// If Percentage Difference is possitive, Blue Up Arrow, Else Red Down Arrow
if($daydiff >= 0){
    $html = $html.'<i class="fa fa-long-arrow-up text-primary"></i>';
}
else{
    $html = $html.'<i class="fa fa-long-arrow-down text-danger"></i>';
}
                  
$html = $html.'
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <!-- End Messages Today Card -->
          
       </div>
       <!-- End Top Row of Cards -->
        
       <!-- Second Row Team -->
       <div class="row">
          <div class="col-lg-12">
             <div class="card" id="dash1-widget-performance">
                <header class="card-header">
                   <h6 class="card-heading">Team</h6>
                </header>
                
                <!-- Team List -->
                <div class="card-body d-flex">
                   <table class="table">
                      <h2 class="text-primary mr-auto">';

// New Instance Of DB Connection
$db =db_connect::infGen();  
$team = $db->prepare("SELECT * FROM Team WHERE instID =".$_SESSION["inst"]); 
$team->execute();

// If Only 1 Row In DB
if ($team->rowCount() == 1 )
{
//Fetch userType
    $row = $team->fetch(PDO::FETCH_OBJ);
	$name = $row->name;
	$job = $row->job;
	$account = $row->account;
    $html = $html.'
                    <tr>
                    <td>
                    </td>
                    <td><strong>'.$name.'</strong></td>
                    <td><p class="text-muted mb-0">'.$job.'</p></td>
                    <td><p class="text-muted mb-0">'.$account.'</p></td>
                    </tr>';

}
// If Not 1 Row in DB
else{
    
    // Cycle Through All Rows
    while($userrow = $team->fetch(PDO::FETCH_OBJ)) {
                    
        $id = $userrow->id;
        $account= $userrow->account;
        $name = $userrow->name;
        $job = $userrow->job;
        $html = $html.'
                    <tr>
                    <td><form action="'.$action.'" method="POST">
                    <input type="hidden" name="id" value="'.$id.'">';
        
        // If Currently Logged In As Admin  or Owner Type Of Account
        if($_SESSION['account'] == 'Admin' || $_SESSION['account'] == 'Owner')
        {
            // If Rows Account Is Regular and Not Own Account, Add Delete + Promote Buttons
            // And Users Profile Is Clickable
            if(($id != $_SESSION['id']) && ($account != 'Owner') && ($account != 'Admin'))
            {
                $html = $html.'
                    <button name="delete" id="'.$id.'" type="submit" value="delete" class="btn btn-sm btn-danger"><i class="zmdi zmdi-close-circle"></i></button>
                    <button name="promote" id="'.$id.'" type="submit" value="promote" class="btn btn-sm btn-primary"><i class="zmdi zmdi-caret-up-circle"></i></button>
                    <td><strong><a href="?page=profile&id='.$id.'">'.$name.'</a></strong></td>';
            }
            // If Rows Account Is Admin And Not Own Account, Add Delete + Promote Buttons
            // And Users Profile Is Clickable
            else if(($id != $_SESSION['id']) && ($account == 'Admin'))
            {
                $html= $html.'
                    <button name="delete" id="'.$id.'" type="submit" value="delete" class="btn btn-sm btn-danger"><i class="zmdi zmdi-close-circle"></i></button>
                    <button name="demote" id="'.$id.'" type="submit" value="demote" class="btn btn-sm btn-secondary"><i class="zmdi zmdi-caret-down-circle"></i></button>
                    <td><strong><a href="?page=profile&id='.$id.'">'.$name.'</a></strong></td>';
            }
            // Else Don't Add Delete + Promote Buttons
            // And Users Profile Is Clickable
            else
            {
                $html = $html.'
                    <a href="#" class="btn btn-sm btn-secondary">Unavailable</a>
                    <td><strong><a href="?page=profile&id='.$id.'">'.$name.'</a></strong></td>';
            }
        }
        // If Not Owner or Admin
        // Users Profile Is Not Clickable
        else
        {
            $html = $html.'<td><strong>'.$name.'</strong></td>';
        }
                        
        $html = $html.'
            </form>
            </td>
            <td><p class="text-muted mb-0">'.$job.'</p></td>
            <td><p class="text-muted mb-0">'.$account.'</p></td>
            </tr>';
                    
    }
}
              
$html = $html.'
                         </h2>
                      </table>
                   </div>
                   <!-- End Team List -->';

// If Account is Owner or Admin, Add Add Team Mate Form            
if($_SESSION['account'] != 'Regular'){
$html = $html.'
                   <!-- Add New Team Mate Form -->
                   <div class="card-body" style="padding-left:45px; padding-right:45px;">
                      <h5>Add New</h5><p class="text-muted mb-0">(Default password: '."'password'".')</p>
                      </br>

                      <form action="'.$action.'" method="POST">
                         <div class="row">
                            
                            <div class="col-md-3">
                               <div class="form-group">
                                  <input class="form-control" name="name" placeholder="Name" required>
                               </div>
                            </div>
                
                            <div class="col-md-3">
                               <div class="form-group">
                                  <input class="form-control" name="job" placeholder="Job Title" required>
                               </div>
                            </div>
                
                            <div class="col-md-3">
                               <div class="form-group">
                                  <input class="form-control" name="email" placeholder="E-mail" required>
                               </div>
                            </div>
                
                            <div class="col-md-3">
                               <div class="form-group">
                                  <button name="new" class="btn btn-block btn-success">Save</button>
                               </div>
                            </div>
                
                         </div><!-- /.row -->
                      </form>
                   </div>
                   <!-- End Add Team Mate Form -->';
            }

$html = $html.'
                </div>
             </div>
          </div>
          <!-- End Second Row Team -->
          
      </div>
    </main>
    <!-- Main Dashboard Content -->
  </div>
  
  <!-- Core Plugins -->
  <script src="assets/vendor/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bower_components/popper.js/dist/umd/popper.min.js"></script>
  <script src="assets/vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="assets/vendor/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="assets/vendor/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/vendor/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/bower_components/waypoints/lib/shortcuts/sticky.min.js"></script>
  <script src="assets/vendor/bower_components/counterup/jquery.counterup.min.js"></script>
  <script src="assets/vendor/bower_components/sweetalert/dist/sweetalert.min.js"></script>
  <script src="assets/vendor/js/jquery.sparkline.min.js"></script>
  <script src="assets/global/js/plugins/dropdown-caret.js"></script>
  <script src="assets/global/js/plugins/firstlitter.js"></script>
  <script src="assets/global/js/plugins/video-modal.js"></script>
  <!-- End Core Plugins -->

  <!-- Plugins For Current Page -->
  <script src="assets/vendor/bower_components/chartist/dist/chartist.min.js"></script>
  <script src="assets/vendor/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendor/jvectormap/maps/jquery-jvectormap-world-mill.js"></script>
  <script src="assets/vendor/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
  <script src="assets/vendor/bower_components/peity/jquery.peity.min.js"></script>
  <!-- End Plugins For Current Page -->

  <!-- Site Wide Scripts -->
  <script src="assets/global/js/main.js"></script>
  <script src="assets/js/site.js"></script>
  <script src="assets/js/navbar.js"></script>
  <script src="assets/js/menubar.js"></script>
  <!-- Site Wide Scripts -->
  
  <!-- Current Page Scripts -->
  <script src="assets/examples/js/dashboards/dashboard.v1.js"></script>
  <!-- End Current Page Scripts -->
  
</body>
</html>

';
?>