<?php

// Reference - https://themeforest.net/item/luxury-responsive-bootstrap-4-admin-template/20881509
// Reference 2 - https://stackoverflow.com/questions/31391037/php-refresh-just-a-part-of-the-page

// Require Header Template
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

<!-- Current Page Styles -->
  <link rel="stylesheet" href="assets/examples/css/apps/messaging.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600">
<!-- End Current Page Styles -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="assets/vendor/bower_components/breakpoints.js/dist/breakpoints.min.js"></script>
<script>Breakpoints({xs: {min:0,max:575},sm: {min:576,max:767},md: {min:768,max:991},lg: {min:992,max:1199},xl: {min:1200,max:Infinity}});</script>
</head>

<!-- Begin Body -->
<body class="menubar-left menubar-dark app-messaging site-header-hidden">
  <div class="site-wrapper">
  
    <!-- Left Navbar -->
    <aside class="site-menubar">
      <div class="site-menubar-inner">
        <ul class="site-menu">
          <!-- MAIN NAVIGATION SECTION -->';
          
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

       <!-- Main Messaging Content -->
       <div class="site-content">
          <div class="app-wrapper">
             <div class="app-main"';

// If Conversation Archived, Make Message Panel Full Height    
if($archived == 'archived')
{
    $html = $html.'style="bottom: 25px;"';
}

$html = $html.'>

             <div class="app-main-content py-2">
      
             <!-- Scrollable Container -->
             <div class="scroll-container px-4">
                <div class="messages-list">
        
                <!-- Ajax/JS Script for Messages -->
                <script type="text/javascript">
                  $(document).ready(function() {
                  $("#Messages").load("assets/ajax/ajaxMessaging.php?group='.$groupid.'");
                    var auto_Message = setInterval(
                    function ()
                    {
                        $("#Messages").load("assets/ajax/ajaxMessaging.php?group='.$groupid.'");
                    }, 1000); 
                  });
                </script>
                <div id="Messages"></div>
                <!-- End Ajax/JS Script -->
        
                </div>
             </div>
             <!-- End Scrollable Container -->';

// If Message Not Archived, Display Send Message Form    
if($archived != 'archived'){
    $html = $html. '
             <div class="app-messaging-form">
                <form action ="'.$action.'" method="POST" style="width: 100%;">
                   <input type="text"name="message" class="msg-form-field" placeholder="Type a message" style="width: 89%;">
                   <input type="submit" class="btn btn-success msg-form-submit" value="SEND" style="width: 9%;">
                </form>
             </div>';
}

$html = $html. '
             </div>
          </div>
        </div>
     </div>
     <!-- End Main Messaging Content -->
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
  <!-- End Site Wide Scripts -->
  
  <!-- Current Page Scripts -->
  <script src="assets/examples/js/dashboards/dashboard.v1.js"></script>
  <!-- End Current Page Scripts -->
  
</body>
</html>

';
?>
