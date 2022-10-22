<?php include("partials-front/menu.php"); ?>

<?php 

    //check whether id is passed or not 
    if(isset($_GET['category_id']))
        {
            $category_id = $_GET['category_id'];
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $category_title = $row['title'];
        }else
            {
                header("location:".$SITEURL.'index.php');
            }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
           <?php if($category_title=="")
                {
                    
                    header("location:".$SITEURL.'index.php');
                    
                }
            ?>
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //create sql query to get foods based on selected category
                $sql1 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
                $res1= mysqli_query($conn, $sql1);
                $count1 = mysqli_num_rows($res1);

                if($count1 >0)
                    {
                        while($row1 = mysqli_fetch_assoc($res1))
                            {
                                $id = $row1['id'];
                                $title = $row1['title'];
                                $description = $row1['description'];
                                $price = $row1['price'];
                                $image_name = $row1['image_name'];

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
                    }else   {
                        echo "<div class='error' > Food Not  Available </div>";
                    }


            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php   include('partials-front/footer.php'); ?>