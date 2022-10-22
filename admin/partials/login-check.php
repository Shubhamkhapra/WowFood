<?php
    //check whether the user is logged in or not
     // Authorization - Access control

     if(!isset($_SESSION['user']))  //if user session is not set
     {
        //user is not logged in  redirect login page
        $_SESSION['no-login-message']="<div class='error text-center'> Please Login to access Admin panel</div>";
        header("location:".$SITEURl.'admin/login.php');

     }
?>