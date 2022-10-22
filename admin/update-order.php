<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
	<div class="wrapper table-responsive-sm">
		<h4>Update Order</h4>
        <br/>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //create sql query all data of select ID
            $sql1 = "SELECT * FROM tbl_order WHERE id='$id'";
            $updateOrder= mysqli_query($conn, $sql1);

            $count1 = mysqli_num_rows($updateOrder);
            if ($count1 == 1) {
                $rows = mysqli_fetch_assoc($updateOrder);
                $food = $rows['food'];
                $price = $rows['price'];
                $qty = $rows['qty'];
                $status = $rows['status'];
                $customer_name = $rows['customer_name'];
                $customer_contact = $rows['customer_contact'];
                $customer_email = $rows['customer_email'];
                $customer_address = $rows['customer_address'];
                
            } else {
                $_SESSION['no-category-found'] = "<div class='error'> Order not Found. </div>";
                header('location:' . $SITEURl . 'manage-order.php');
            }
        } else {
            header('location:' . $SITEURl . 'manage-order.php');
        }
        ?>

    <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl_third table table-striped table-hover mt-5 mb-5">
            <tr>
                <td>Food Name :- </td>
                <td ><b><?php echo $food ; ?> </b></td>
            </tr> 
            <tr>
                <td>Price :-  </td>
                <td ><b>&#8377;<?php echo $price ; ?></b></td>
            </tr>

            <tr>
                <td>Qty :-</td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty; ?>">
                </td>
            </tr> 
            <tr>
                <td>Status :-</td>
                <td>
                    <select name="status">
                            <option  <?php if ($status =="Ordered"){ echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if ($status =="On Delivery"){ echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($status =="Delivered"){ echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if ($status =="Cancelled"){ echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Customer Name :-</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
            </tr>
            
            <tr>
                <td>Customer contact :-</td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>
            </tr> 
            
            <tr>
                <td>Customer Email :-</td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>
            
            <tr>
                <td>Customer Address :-</td>
                <td>
                    <textarea name="customer_address" cols="30" rows="5" > <?php echo $customer_address; ?></textarea>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="text-center">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Ordered" class="btn-secondary">
                    </td>
            </tr>

        </table>
    </form>

    <?php

        if(isset($_POST['submit'])) : ?>
            <?php
                {
                    $id = $_POST['id'];
					
					$price = $_POST['price'];
					$qty = $_POST['qty'];
				    $total = $price * $qty;

					$status = $_POST['status'];
					$customer_name = $_POST['customer_name'];
					$customer_contact= $_POST['customer_contact'];
					$customer_email = $_POST['customer_email'];
					$customer_address = $_POST['customer_address'];


                    $sql3 = "UPDATE tbl_order SET 
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name= '$customer_name',
                        customer_contact= '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address= '$customer_address'
                        WHERE id=$id 
                    ";

                    $res3 = mysqli_query($conn, $sql3);

                    if($res3 == true)
                        {
                            $_SESSION['update'] = "<div class='success text-center' > Order Updated Successfully ...</div> ";
                            header("location:".$SITEURl.'manage-order.php');
                        }else
                            {
                                $_SESSION['update'] = "<div class='error text-center' > Failed to  Updated  Order ...</div> ";
                                header("location:".$SITEURl.'manage-order.php');
                            }
                }
            ?>
    <?php endif ; ?>


    </div>
</div>


<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>