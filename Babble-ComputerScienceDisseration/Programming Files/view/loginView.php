<?php

// Reference - https://themeforest.net/item/luxury-responsive-bootstrap-4-admin-template/20881509

require('assets/templates/header.php');

$html=$html.'
  
  <!-- Core Plugins -->
  <link rel="stylesheet" href="assets/vendor/css/bootstrap.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendor/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.css">
  <!-- End Core Plugins -->
  
  <!-- Site Wide Stylesheets -->
  <link rel="stylesheet" href="assets/css/site.css">
  <!-- End Site Wide Stylesheets -->

  <!-- Styles For Current Page -->
  <link rel="stylesheet" href="assets/examples/css/pages/login.css">
  <!-- End Styles For Current Page -->
  
  <style>@import "https://fonts.googleapis.com/css?family=Roboto:300,400,500,600";</style>
</head>

<!-- Begin Body -->
<body class="simple-page page-login">

<!-- Login Page Header -->
<header class="login-page-header d-flex">
  <div class="mr-auto">
    <a href="#" class="d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 164 164">
        <image width="164" height="164" xlink:href="data:img/png;base64,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"/>
      </svg>
      <h5 class="text-white m-0">&nbsp;Babble</h5>
    </a>
  </div>

  <div id="form-switch-btns" class="btn-group switch-btns">
    <a href ="?page=login"><button class="btn" disabled>Login</button></a>
    <a href ="?page=register"><button class="btn" >Register</button></a>
  </div>
</header>
<!-- End Login Page Header -->

<!-- Main Register Page Content -->
<div class="login-page-wrap">

  <!-- Left Side -->
  <div class="side first-side">
    <div class="side-content text-center">
    </br>
    </br>
      
       <div class="item">
          <h1 class="mb-3">Welcome</h2>
          <h4>This web application has been created by Jordan Brannan for his BSc Computer Science final project at Goldsmiths College, University of London.</h4>
        </div>
        
        </br>
        </br>
        
        <div class="item">
          <h6 class="mb-3">Browser</h6>
          <p>Babble has been created using Google Chrome, for the best experience, please make sure that application is used with this browser.</p>
        </div>
        
        </br>
        </br>
        
        <div class="item">
          <a style="color:white;" href="?page=privacy">Privacy</a> <a style="color:white;" href="?page=terms">Terms of Use</a></h7>
        </div>

    </div>
  </div>
  <!-- End Left Side -->
  
  <!-- Right Side -->
  <div class="side second-side">
    <div class="side-content">
      <div class = "side-content text-center">
      <h4 class="my-5 font-weight-light">Sign In!</h4>
      </div>
        
        <!-- Login Form -->
        <form id="signin-form" class="form" action="'.$action.'" method="POST">
        
          <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email">
          </div>
          
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          
          <input type="submit" class="btn btn-outline-success py-2 mt-5" style="width: 100%;" value="Sign in">
          
        </form>
        <!-- End Login Form -->
      
    </div>
  </div>
  <!-- End Right Side -->
  
  
</div>
<!-- End Main Login Page Content -->

<!-- Core Plugins -->
  <script src="assets/vendor/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- End Core Plugins -->

<!-- Scripts For Current Page -->
  <script src="assets/examples/js/pages/login.js"></script>
<!-- End Scripts For Current Page -->

</body>
</html>';

?>
