<?php
ob_start();
?>
<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
	<div class="wrapper">
		<h4>Add Food </h4>
		<br />

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

		<br />

		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl_third table table-striped table-hover mt-5 mb-5">
				<tr>
					<td>Title:- </td>
					<td><input type="text" name="title" placeholder="Title of the food"></td>
				</tr>

				<tr>
					<td>Description:- </td>
					<td><textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea></td>
				</tr>

				<tr>
					<td>Price:-</td>
					<td><input type="number" name="price"></td>
				</tr>

				<tr>
					<td> Select Image:-</td>
					<td><input type="file" name="image"></td>
				</tr>

				<tr>
					<td>Category ID:-</td>
					<td>
						<select name="category">

							<?php
							//create php code to display categories from database
							// create sql to get all active categories from database adn dropdown list
							$sql = "SELECT * FROM tbl_category WHERE active='Yes'";
							$res = mysqli_query($conn , $sql);
							$count = mysqli_num_rows($res);

							if ($count > 0) {
								while ($row = mysqli_fetch_assoc($res)) {
									$id = $row['id'];
									$title = $row['title'];
							?>

									<option value="<?php echo $id; ?>"><?php echo $title; ?> </option>

								<?php
								}
							} else {
								?>
								<option value="0">No Category Found</option>

							<?php
								// echo '<script>alert("No Admin User found & you can add Admin ")</script>';
							}

							?>
						</select>
					</td>

				</tr>

				<tr>
					<td>Featured:-</td>
					<td>
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> NO
					</td>
				</tr>

				<tr>
					<td>Active:-</td>
					<td>
						<input type="radio" name="active" value="Yes">Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" value="Add Food" name="submit" class="btn-secondary">

					</td>
				</tr>

			</table>

		</form>

		<!-- Add Food form end -->

		<?php

		//check the submit work or not
		if (isset($_POST['submit'])) : ?>
			<?php 
				{
					//1 get the data from form
					$title = $_POST['title'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$category= $_POST['category'];
					

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

						if(isset($_FILES['image']['name'])){
							// to upload image we need image name , source path and destination path
							$image_name =$_FILES['image']['name'];

							
							if($image_name !="")
								{
									$ext = end(explode('.',$image_name));
									$image_name = "Food_Name".rand(000,999).'.'.$ext;
									$source_p = $_FILES['image']['tmp_name'];

									$destination_path="../images/".$image_name;

									$upload = move_uploaded_file($source_p , $destination_path);
									
									if($upload == false)
									{
										$_SESSION['upload'] = "<div class='error'> Failed to upload image. </div>";
										header('location:'.$SITEURl.'add-food.php');
										ob_end_flush();
										die();
									}
								}else
									{
										$image_name="";
									}

							
						}

					//3. insert into database and redirect message

						$insertFoodQry = "INSERT INTO tbl_food SET 
						title = '$title',
						description = '$description',
						price=$price,
						image_name ='$image_name' ,
						category_id='$category',
						featured='$featured', 
						active = '$active' ";

						$insertFood = mysqli_query($conn, $insertFoodQry);

						if($insertFood == TRUE)
						{
							$_SESSION['add']= "<div class='sucess'>Food Added Successfully </div>   " ;
							header("location:".$SITEURl.'manage-food.php');
							ob_end_flush();
						}else
							{
								$_SESSION['add']= "<div class='error'>Failed to Add Food !!! </div>   " ;
								header("location:".$SITEURl.'manage-food.php');
								ob_end_flush();
							}


				}
			?>

		<?php endif; ?>




	</div>
</div>
<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>