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

<!-- Plugins For Current Page -->
  <link rel="stylesheet" href="assets/vendor/bower_components/lightbox2/dist/css/lightbox.min.css">
<!-- End Plugins For Current Page -->

<!-- Current Page Styles -->
  <link rel="stylesheet" href="assets/examples/css/pages/profile.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600">
<!-- End Curren Page Styles -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="assets/vendor/bower_components/breakpoints.js/dist/breakpoints.min.js"></script>
<script>Breakpoints({xs: {min:0,max:575},sm: {min:576,max:767},md: {min:768,max:991},lg: {min:992,max:1199},xl: {min:1200,max:Infinity}});</script>
</head>

<!-- Begin Body -->
<body class="menubar-left menubar-dark no-padding page-profile">
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

    <!-- Main Profile Content -->
    <main class="site-main">
    
      <!-- Profile Page Header -->
      <header class="site-header">
        <div class="jumbotron jumbotron-fluid">
          <div class="jumbotron-text">
            <h4 class="text-primary">'.$name."'s Profile".'</h4>
            <small class="font-italic text-muted">Here you are able to edit teammate details and update passwords.</small>
          </div>
        </div>
        
        <div class="breadcrumb">
          <ol class="breadcrumb-tree">
            <li class="breadcrumb-item">
              <a href="'.$action.'">
                <span class="zmdi zmdi-home mr-1"></span>
                <span>Home</span>
              </a>
            </li>
            <li class="breadcrumb-item active"><a href="'.$action.'">Profile</a></li>
          </ol>
        </div>
      </header>
      <!-- End Profile Page Header -->
    
      <!-- Users Profile/Form -->
      <div class="site-content">
        <div class="profile-wrapper">
           
           <!-- Left Side -->
           <div class="profile-section-user">
              <div class="hidden-sm-down">
                 <div class="profile-info-general p-4">
                    
                    <div class="text-center">
                       <h3 class="mb-3">Current Details</h3>
                       
                       </br>
                       </br>
                       
                    </div>
                    
                    <table class="table">

                       <tr>
                          <td><strong>USER ID:</strong></td>
                          <td><p class="text-muted mb-0">'.$id.'</p></td>
                          </br>
                       </tr>
                        
                       <tr>
                          <td><strong>INSTITUTION:</strong></td>
                          <td><p class="text-muted mb-0">'.$_SESSION["instName"].'</p></td>
                          </br>
                       </tr>
          
                       <tr>
                          <td><strong>NAME:</strong></td>
                          <td><p class="text-muted mb-0">'.$name.'</p></td>
                          </br>
                       </tr>
          
                       <tr>
                          <td><strong>JOB TITLE:</strong></td>
                          <td><p class="text-muted mb-0">'.$job.'</p></td>
                          </br>
                       </tr>
          
                       <tr>
                          <td><strong>EMAIL:</strong></td>
                          <td><p class="text-muted mb-0">'.$email.'</p></td>
                       </tr>
          
                    </table>
                 </div>
              </div>
           </div>
           <!-- End Left Side -->

           <!-- Right Side -->
           <div class="profile-section-main">
              <div class="tab-content profile-tabs-content">
                 <div class="tab-pane active" id="profile-settings" role="tabpanel">
                    <div class="row">
                       <div class="text-center">
                          </br>
                             <div class="col-xl-12 col-md-9">
                                <h3 class="mb-3">Update Details</h3>
                                </br>
                                
                                <!-- Update Details Form -->
                                <form action="'.$action.'" method="POST">
                                <input type="hidden" name="id" value="'.$id.'">
                                  
                                <div class="row">
                                   <div class="col-md-12">
                                      <div class="form-group">
                                         <input type="text" class="form-control" name="name" placeholder="Name" required>
                                      </div>
                                   </div><!-- /.col- -->
                                </div>

                                <div class="row">
                                   <div class="col-md-12">
                                      <div class="form-group">
                                         <input type="text" class="form-control" name="job" placeholder="Job Title" required>
                                      </div>
                                   </div><!-- /.col- -->
                                </div>

                                <div class="row">
                                   <div class="col-md-12">
                                      <div class="form-group">
                                         <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                                      </div>
                                   </div><!-- /.col- -->
                                </div>
                
                                <div class="row">
                                   <div class="col-md-12">
                                      <div class="form-group">
                                         <button name ="details" class="btn btn-block btn-success mt-0">Save</button>
                                      </div>
                                   </div><!-- /.col- -->
                                </div><!-- /.row -->
                
                                </form>
                                <!-- End Update Details Form -->
                                
                                </br>
                                
                                <!-- Change Password Form -->
                                <form action="'.$action.'" method="POST">
                                <input type="hidden" name="id" value="'.$id.'">
                                <h3 class="my-4 profile-edit-section-heading">Change Password</h3>
                                </br>
                                
                                <div class="row">
                                   <div class="col-md-12">
                                      <div class="form-group">
                                         <input type="password" class="form-control" name="oldPass" placeholder="Your Password" required>
                                      </div>
                                   </div><!-- /.col- -->
                
                                   <div class="col-md-12">
                                      <div class="form-group">
                                         <input type="password" class="form-control" name="newPass" placeholder="New Password" required>
                                      </div>
                                   </div><!-- /.col- -->

                                   <div class="col-md-12">
                                      <div class="form-group">
                                         <input type="password" class="form-control" name="confPass" placeholder="Confirm Password" required>
                                      </div>
                                   </div><!-- /.col- -->
                                </div><!-- /.row -->
                                
                                <div class="row">
                                   <div class="col-md-12">
                                      <button name="password" class="btn btn-block btn-success mt-0">Save</button>
                                   </div><!-- /.col- -->
                                </div><!-- /.row -->
                                
                                </br>
                                
                                </form>
                                <!-- End Change Password Form -->
                                
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <!-- End Right Side -->
              
           </div>
        </div>
        <!-- End Users Profile/Form -->
        
     </main>
     <!-- End Main Profile Content -->
     
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
  <script src="assets/vendor/bower_components/lightbox2/dist/js/lightbox.min.js"></script>
  <!-- End Plugins For Current Page -->

  <!-- Site Wide Scripts -->
  <script src="assets/global/js/main.js"></script>
  <script src="assets/js/site.js"></script>
  <script src="assets/js/navbar.js"></script>
  <script src="assets/js/menubar.js"></script>
  <!-- End Site Wide Scripts -->
  
</body>
</html>
';
?>