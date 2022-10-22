<?php
ob_start();
?>
<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
    <div class="wrapper table-responsive-sm">
        <h4>Update Food</h4>

        <br />

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //create sql query all data of select ID
            $sql1 = "SELECT * FROM tbl_food WHERE id='$id'";
            $updateFood = mysqli_query($conn, $sql1);

            $count1 = mysqli_num_rows($updateFood);
            if ($count1 == 1) {
                $rows = mysqli_fetch_assoc($updateFood);
                $title = $rows['title'];
                $description = $rows['description'];
                $price = $rows['price'];
                $current_image = $rows['image_name'];
                $current_category = $rows['category_id'];
                $featured = $rows['featured'];
                $active = $rows['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='error'> Food not Found. </div>";
                header('location:' . $SITEURl . './manage-food.php');
                
            }
        } else {
            header('location:' . $SITEURl . './manage-food.php');
        }


        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl_third table table-striped table-hover mt-5 mb-5">
                <tr>
                    <td>Title :-</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:- </td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                </tr>

                <tr>
                    <td>Price:-</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>

                <tr>
                    <td>Current Image :- </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo $SITEURl; ?>../images/<?php echo $current_image; ?> " width='150px'>
                        <?php

                        } else {
                            echo "<div class='error'> Image Not Add!! </div>";
                        }
                        ?>

                    </td>

                </tr>

                <tr>
                    <td>New Image:-</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>
                        Category:-
                    </td>
                    <td>
                        <select name="category">

                            <?php
                            //create php code to display categories from database
                            // create sql to get all active categories from database adn dropdown list
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>

                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?> </option>

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
                    <td>
                        Featured :-
                    </td>
                    <td>
                        <input <?php if ($featured == 'Yes') {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == 'No') {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :-</td>
                    <td>
                        <input <?php if ($active == 'Yes') {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == 'No') {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>

                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php

        //check the submit work or not
        if (isset($_POST['submit'])) 
             {
                //1. Get the values
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                //2. updating new image if select and remove previous image

                if (isset($_FILES['image']['name'])) 
                {
                    $image_name = $_FILES['image']['name'];
                    if ($image_name != "") 
                    {
                        //upload new image and remove old image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Name".rand(000,999).'.'.$ext;
                        $source_p = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/" . $image_name;

                        $upload = move_uploaded_file($source_p, $destination_path);

                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'> Failed to upload image. </div>";
                            header('location:' . $SITEURl . './manage-food.php');
                            die();
                        }

                        //remove  current image
                        if ($current_image != "") {
                            $remove_path = "../images/" . $current_image;
                            $removed = unlink($remove_path);

                            if ($removed == false) {
                                $_SESSION['remove-failed'] = "<div class='error'> Failed to remove current image. </div>";
                                header('location:' . $SITEURl . './manage-food.php'); ob_end_flush();
                                die(); //stop process
                            }
                        }
                    } else
                        {
                            $image_name = $current_image;
                        }
                }else
                    {
                        $image_name = $current_image;
                    }

                //3 update database & redirect category image

                $sqlUpdate = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name ='$image_name',
                category_id= '$category',
                featured='$featured', 
                active = '$active' 
                WHERE id=$id
                ";

                $sqlUpdateConn = mysqli_query($conn, $sqlUpdate);

                if($sqlUpdateConn == TRUE)
                {
                    $_SESSION['update'] = "<div class='success'> Category Update Successfuly. </div>";
                    header("location:".$SITEURl.'./manage-food.php'); ob_end_flush();
                }else
                    {
                    $_SESSION['update'] = "<div class='error'> Category Update Failed !!!. </div>";
                    header("location:".$SITEURl.'./manage-food.php'); ob_end_flush();
                    }



            }
        
       ?>

    </div>
</div>


<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>