<?php
ob_start();
?>
<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
	<div class="wrapper">
		<h4>Add Admin</h4>

		<br/>
		<?php 
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); //remove session message 
                }
        ?>
        <br/><br>

		<form action="add-admin.php" method="POST">
			
			<table class="tbl_third table table-striped table-hover mt-5 mb-5">
				<tr>
					<td>Full Name: </td>
					<td><input type="text" name="full_name" placeholder="Enter your name"></td>
				</tr>

				<tr>
					<td> UserName: </td>
					<td><input type="text" name="username" placeholder="Your Username"></td>
				</tr>

				<tr>
					<td> Password: </td>
					<td><input type="Password" name="password" placeholder="Your Password"></td>
				</tr>

				<tr>
					<td colspan="2"> <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> </td>
					
				</tr>

			</table>

		</form>

	</div>
	
</div>
<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>

<?php

	//Process the value from  Form and save it in Database
	// Check whether the button is clicked or not
	
	if (isset($_POST['submit'])) {
		//button clicked  1.Get the data from form 
		$full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = md5($_POST['password']);  //Password encryption with MD5

		//2. sql query to save the data into database

		$sql = "INSERT INTO tbl_admin SET full_name='$full_name', username='$username', password = '$password' ";

		//3. Execute the query and saving data inyo database

		$res = mysqli_query($conn, $sql) or die();
		if($res->error)
			{
				echo ("Error Description: ".$res->error);
			}

		//4. Check whether the (query is executed) data is inserted or not  and display appropriate message

		if($res==TRUE)
			{
				//create a session variable to display message
				
				$_SESSION['add']= "<div class='success'> Admin Added Successfully </div>";
                

				//redirect page to manage admin
				header("location:".$SITEURl.'manage-admin.php');
				ob_end_flush();

			}else
				{
					//create a session variable to display message
					$_SESSION['add']="<div class='error'>Fail to add Admin </div> ";

					//redirect page to Add admin
					header("location:".$SITEURl.'manage-admin.php');
					ob_end_flush();
				}


	}else
		{
			//button not click
			

		}

?>