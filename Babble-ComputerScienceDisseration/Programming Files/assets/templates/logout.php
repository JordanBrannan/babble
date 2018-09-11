<?php

// End Session, Redirect To Login
session_start(); 
session_destroy();
echo "<script>location.href='?page=login';</script>";		        

?>