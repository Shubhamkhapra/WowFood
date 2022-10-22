<?php include("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
            //get the search keyword
            $getSearch = $_POST['search'];
            $search =  mysqli_real_escape_string($conn,$getSearch) ;
            if($search== "")
                {
                    header('location:'.$SITEURL.'index.php');
                }
        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

             //sql query to get foods based on search keyword
             $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
             $res = mysqli_query($conn, $sql);
             $count = mysqli_num_rows($res);

             if($count > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];

                                ?>
                                <div class="food-menu-box">
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
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food-price">&#8377;<?php echo $price; ?></p>
                                        <p class="food-detail">
                                        <?php echo $description; ?>
                                        </p>
                                        <br>

                                        <a href="<?php echo $SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>

                                <?php
                            }
                }else 
                    {
                        echo " <div class='error text-center'> <h5=1>food Not Avaliable!!!<h1> </div> ";
                    }

            ?>

            <div class="clearfix"></div>
       
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php   include('partials-front/footer.php'); ?>