<?php
	
	//start session
	session_start();

    //create constants to store Non repating values
    // $dsn = 'localhost:3306';
    $dsn = "localhost";
    $user = "id19484106_sk";
    $password = "Devilking21@";
    $DB_NAME_MY = "id19484106_foodorder"; 
	$SITEURL = "https://shubhamkhapra.000webhostapp.com/";
	$conn = mysqli_connect($dsn, $user, $password) ;
	if (mysqli_connect_errno())
		{
			echo "failed to connect to Mysql: ".mysqli_connect_errno();
			exit();
		}

	$db_select = mysqli_select_db($conn, $DB_NAME_MY) or die("Unable to connect query");

?>