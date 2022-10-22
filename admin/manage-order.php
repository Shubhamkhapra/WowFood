<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content" style="height:100vh;">
	<div class="wrapper table-responsive-sm">
		<h4>Manage Order</h4>

		<?php
		if(isset($_SESSION['update']))
			{
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}
		?>
		<br>

        <table class="tbl_full table table-striped table-hover mt-5 mb-5">
        	<tr>
        		<th>S.No</th>
        		<th>Food</th>
        		<th>Price</th>
        		<th>Qty.</th>
        		<th>Total</th>
        		<th>Order Date</th>
        		<th>Status</th>
        		<th>Customer Name</th>
        		<th>Customer Contact</th>
        		<th>Customer Email</th>
        		<th>Customer Address</th>
        		<th>Action</th>

        	</tr>

			<?php
				$sql = "SELECT * FROM tbl_order ORDER BY id DESC";
				$res = mysqli_query($conn , $sql);
				$count = mysqli_num_rows($res);
				$sn= 1;
				if($count > 0)
					{
						while($row=mysqli_fetch_assoc($res))
						{
							$id = $row['id'];
							$food = $row['food'];
							$price = $row['price'];
							$qty = $row['qty'];
							$total = $row['total'];
							$order_date = $row['order_date'];
							$status = $row['status'];
							$customer_name = $row['customer_name'];
							$customer_contact= $row['customer_contact'];
							$customer_email = $row['customer_email'];
							$customer_address = $row['customer_address'];
							?>

								<tr>
									<td><?php echo $sn++; ?> </td>
									<td><?php echo $food; ?></td>
									<td>&#8377;<?php echo $price; ?></td>
									<td><?php echo $qty; ?></td>
									<td><?php echo $total; ?></td>
									<td><?php echo $order_date; ?></td>

									<td>
										<?php 
											if($status =="Ordered")
												{
													echo "<label> $status </label>";
												}elseif($status=="On Delivery")
													{
														echo "<label style='color: orange'> $status </label>";
													}elseif($status=="Delivered")
													{
														echo "<label style='color: green'> $status </label>";
													}elseif($status=="Cancelled")
													{
														echo "<label style='color: red'> $status </label>";
													}
										?>
									</td>

									<td><?php echo $customer_name; ?></td>
									<td><?php echo $customer_contact; ?></td>
									<td><?php echo $customer_email; ?></td>
									<td><?php echo $customer_address; ?></td>
									<td>
										<a href="<?php echo $SITEURl ; ?>update-order.php?id=<?php echo $id; ?>" class="text-warning" > <span class="material-symbols-outlined">edit </span> </a>
									</td>
								</tr>

							<?php

						}
					}else
						{
							echo "<tr><td colspan='12' class='text-center  error'> Orders Not Available </td></tr>";
						}
			?>

        	

        	
        </table>

	</div>
</div>
<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>