<?php
ob_start();
?>
<?php include("../config/constants.php");

	if(isset($_SESSION['login']))
				{
					
					//header("location:".$SITEURl.'index.php');
                     
					unset($_SESSION['login']);
					ob_end_flush();
				}
	if(isset($_SESSION['user'])){
	    unset($_SESSION['user']);
					ob_end_flush();
	}

				if (isset($_SESSION['no-login-message'])) {
					echo $_SESSION['no-login-message'];
					unset ($_SESSION['no-login-message']);
				}
			?>

<!DOCTYPE html>
<html>
<head>
	 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://kit.fontawesome.com/ef417ecd31.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
	<title>Login Admin</title>

</head>
<body >
	<div class="login">
		<h4 class="text-center">Login</h4>

	
			<br> 

		<!-- login Form start-->

		<form action="" method="POST" class="text-center" autocomplete="off">
		    
		  <div class="fields">
                <div class="email"><i class="fa-regular fa-envelope"></i><input type="text" name="username"  class="user-email" placeholder="Enter Username" required>
                   
                </div>
                <div class="password"><i class="fa-solid fa-lock"></i>	<input type="password" name="password" placeholder="Enter Password" class="pass-input" required><br><br>

                    <span><?php echo $passErr ?></span>
                </div>
                <button class="signin-button" name='submit'>Login</button>
            </div>    
            
			
        <!--	 Username:- <br>
			<input type="text" name="username" placeholder="Enter Username" required> <br><br>

			Password:-<br>
		<input type="password" name="password" placeholder="Enter Password" required><br><br>

		<input type="submit" name="submit" value="Login" class="btn-primary"><br><br> -->

		</form>
		



		<!-- login Form End -->

		<p style="text-align:center; margin-top:100px" >	&#169; Wow Food. All Rights Reserved</p>
	</div>
</body>
</html>


<?php

	if(isset($_POST['submit'])) : ?>
		<?php	{
				// process for login
				// $username = $_POST['username'];
				$username = mysqli_real_escape_string($conn, $_POST['username']);

				$Rawpassword = md5($_POST['password']);
				$password = mysqli_real_escape_string($conn ,$Rawpassword);

				//Sql check the user with username and password exist or not
				$sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";
				$res = mysqli_query($conn, $sql);

				$count = mysqli_num_rows($res);

				if($count==1)
					{
						$_SESSION['login']="<div class='success'> Login Successful. </div>";
						$_SESSION['user']= $username;  //check the user is login or not and logout will unset 


						header("location:".$SITEURl.'index.php');
						ob_end_flush();
						
					}else
						{
							$_SESSION['login']="<div class='error text-center'> username and password did not match </div>";
							header("location:".$SITEURl.'login.php');
							ob_end_flush();
						}

			} 
			?>
			

 <?php endif ; ?>
