<?php include("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo $SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                //create sql query to display category from database which is featured yes or active yes
                $sqlCate = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                $displayCate = mysqli_query($conn, $sqlCate);
                $countCate = mysqli_num_rows($displayCate);

                if($countCate>0)
                    {
                        //categry available
                        while($row=mysqli_fetch_assoc($displayCate))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];

                                ?>

                                <a href="<?php echo $SITEURL; ?>category-foods.php?category_id=<?php echo $id ; ?>">
                                    <div class="box-3 float-container">
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
                                        

                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>

                                <?php
                            }
                    }else
                        {
                            //Category Not  available
                            echo " <script> <div class='error' >alert('Category Not Avaliable!!! ') </div> </script>";
                        }

            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
                $sqlFood = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6 ";
                $displayFood = mysqli_query($conn, $sqlFood);
                $countFood = mysqli_num_rows($displayFood);

                if($countFood>0)
                    {
                        while($row2 = mysqli_fetch_assoc($displayFood))
                            {
                                $id = $row2['id'];
                                $title = $row2['title'];
                                $description = $row2['description'];
                                $price = $row2['price'];
                                $image_name = $row2['image_name'];

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
                            echo " <script> <div class='error' >alert('Food Not Avaliable!!! ') </div> </script>";
                        }

            ?>

           
            <div class="clearfix"></div>



        </div>

        <p class="text-center">
            <a href="<?php echo $SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

 <?php   include('partials-front/footer.php'); ?>
