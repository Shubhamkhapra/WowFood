<?php ob_start();?>

<?php 

    include("../config/constants.php");

// destroy the session and redirect to login page

    session_destroy();

    

    header("location:./login.php");
    //header("location:".$SITEURl."admin/login.php");
    ob_end_flush();
    //.'admin/login.php'


?>