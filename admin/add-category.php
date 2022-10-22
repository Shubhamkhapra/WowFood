<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
	<div class="wrapper">
		<h4>Add Category </h4>
		<br>

		<?php
				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}
				if (isset($_SESSION['upload'])) {

					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}
		?>
		<br>
		<!-- Add Category form start -->

		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl_third table table-striped table-hover mt-5 mb-5">
				<tr>
					<td>
						*Title :- 
					</td>
					<td>
						<input type="text" name="title" placeholder="Category Title">
					</td>
				</tr>

				<tr>
					<td>
						Select Image :-
					</td>
					<td><input type="file" name="image"></td>
				</tr>
				

				<tr>
					<td>
						*Featured :-
					</td>
					<td>
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> NO
					</td>
				</tr>

				<tr>
					<td>*Active :-</td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Category" class="btn-secondary">
						
					</td>
				</tr>
			</table>
			
		</form>

		<!-- Add Category form end -->

		<?php

			//check the submit work or not
			if(isset($_POST['submit'])) :?>
				<?php
					{
						//1. Get the values
						
						 $title = $_POST['title'];

						//check radio buttion , we need to check button selected or not
						if(isset($_POST['featured']))
							{
								$featured = $_POST['featured'];
							}
						else
							{
								//set defult value
								$featured = "No";
							}

						if (isset($_POST['active']))
							{
								 $active = $_POST['active'];
							}
						else
							{
								 $active = "No";
							}

						// check the image select or not set the value for image name accroding

						// print_r($_FILES['image'] );
						// // die(); 
						if(isset($_FILES['image']['name'])){
							// to upload image we need image name , source path and destination path
							$image_name =$_FILES['image']['name'];

							
							if($image_name !="")
								{
									$ext = end(explode('.',$image_name));
									$image_name = "Food_Category".rand(000,999).'.'.$ext;
									$source_p = $_FILES['image']['tmp_name'];

									$destination_path="../images/".$image_name;
									// $destination_path="../images/category/".$image_name;

									$upload = move_uploaded_file($source_p , $destination_path);
									
									if($upload == false)
									{
										$_SESSION['upload'] = "<div class='error'> Failed to upload image. </div>";
										header('location:'.$SITEURl.'/admin/add-category.php');
										die();
									}
								}else
									{
										$image_name="";
									}

							
						}


						// 2. Query to insert data in database
						$insertQuery = "INSERT INTO tbl_category SET 
							title = '$title',
							image_name = '$image_name',
							featured = '$featured',
							active = '$active'
						";

						$insertExecute = mysqli_query($conn, $insertQuery);

						if ($insertExecute==true) 
							{
								$_SESSION['add']= "<div class='sucess'>Category Added Successfully </div>   " ;
								header("location:".$SITEURl.'/admin/manage-category.php');
							}
						else
							{
								$_SESSION['add']= "<div class='error'>Fail to Added Category </div>   " ;
								header("location:".$SITEURl.'/admin/manage-category.php');
							}

					}
				?>

		<?php endif ;?>

	</div>
</div>
<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>