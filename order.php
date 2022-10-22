<?php include("partials-front/menu.php"); ?>

<?php
    if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];
            $sql = "SELECT * FROM tbl_food WHERE id='$food_id'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                }else
                    {
                        
                        header("location:".$SITEURL.'index.php');
                    }

        }else
            {
                header("location:".$SITEURL.'index.php');
            }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php 
                        //check image is available or not 
                        if($image_name=="")
                            {
                                echo "<div class = 'error'>Image Not Available. </div> ";
                            }else
                               {
                                    ?>
                                        <img src="<?php echo $SITEURL; ?>images/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                    ?>                 
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                            <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">&#8377;<?php echo $price; ?></p>
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. shubham khapra" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. shubham@sk.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                if(isset($_POST['submit'])) : ?>
                <?php
                    {
                       $food = $_POST['food'];
                       $price = $_POST['price'];
                       $qty = $_POST['qty'];
                       $total = $price * $qty;
                       $order_date = date("Y-m-d h:i:sa");
                       $status = "Ordered"; //ordered , on Delivery, Cancelled
                       $customer_name = $_POST['full-name'];
                       $customer_contact = $_POST['contact'];
                       $customer_email = $_POST['email'];
                       $customer_address = $_POST['address'];

                       $sql2 = "INSERT INTO tbl_order SET
                        food='$food',
                        price=$price,
                        qty = $qty,
                        total = $total,
                        
                        status = '$status',
                        customer_name= '$customer_name',
                        customer_contact= '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address= '$customer_address'
                       ";
                        // echo $sql2 ;
                        // die();
                       $res2 = mysqli_query($conn, $sql2);

                       if($res2==true)
                        {
                            $_SESSION['order']= "<div class='success text-center'><h2> Food  Order Successfully ..  </h2></div> ";
                            header("location:".$SITEURL.'index.php');
                        }else
                            {
                                $_SESSION['order']= "<div class='error text-center' > <h2> Failed to  Order  Food  !!! </h2> </div> ";
                                header("location:".$SITEURL.'index.php');
                            }




                    }
                ?>
            <?php endif; ?>



        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
  
<?php   include('partials-front/footer.php'); ?>