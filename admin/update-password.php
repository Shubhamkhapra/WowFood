

<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->

<div class="main-content">
	<div class="wrapper table-responsive-sm">
		<h4>Update Password</h4>
		<br/>

		<?php 
				if (isset($_GET['id'])) {
					$id= $_GET['id'];
				}
		?>

		<form action="" method="POST">
             
            <table class="tbl_third table table-striped table-hover mt-5 mb-5">
            	<tr>
            		<td>Current Password: </td>
            		<td><input type="password" name="current_password" placeholder="Current Password"></td>
            	</tr>

            	<tr>
            		<td>New Password: </td>
            		<td><input type="password" name="new_password" placeholder="New Password"></td>
            	</tr>

            	<tr>
            		<td>Confirm Password: </td>
            		<td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
            	</tr>

            	<tr>
            		
            		<td colspan="2"> 
            			<input type="hidden" name="id" value="<?php echo $id; ?>">
            			<input type="submit" name="submit" value="Change Password" class="btn-secondary"></td>
            	</tr>

            </table>

        </form>

	</div>
	
</div>

<?php  
	//check button click or not
	if (isset($_POST['submit'])) {
		
		//1. Get the data from form
		$id = $_POST['id'];
		$current_password = md5($_POST['current_password']);
		$new_password = md5($_POST['new_password']);
		$confirm_password = md5($_POST['confirm_password']);


		//2. check user with current Id and password exists or not

		$sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

		$check = mysqli_query($conn , $sql);

		if($check == TRUE)
			{
				$count = mysqli_num_rows( $check);
				if ($count==1) {
					
					if($new_password==$confirm_password){
						
						//update password
						$updatePwdsql = "UPDATE tbl_admin SET password= '$new_password' WHERE id= $id";
						$updatePwd = mysqli_query($conn , $updatePwdsql);

						//check query is udpate or not
						if($updatePwd == TRUE)
								{
									$_SESSION['pwd-change']= "<div class='success'> Password  Change successful. </div>";
									header("location:".$SITEURl.'manage-admin.php');
								}
								else
								{
									$_SESSION['pwd-change']= "<div class='error'> fail to update Password !!! </div>";
									header("location:".$SITEURl.'manage-admin.php');
								}
					}
					else
						{
							$_SESSION['pwd-not-match']= "<div class='error'> Password not match!!! </div>";
							header("location:".$SITEURl.'manage-admin.php');
						}

				}
				else
						{
							$_SESSION['user-not-found']= "<div class='error'> User  not Found!!! </div>";
							header("location:".$SITEURl.'manage-admin.php');
						}
			}
		//3. CHeck the new password and conform match or not

		//4. change passowrd if all above true


	}else
		{

		}
	
?>

<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>