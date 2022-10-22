<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
    <div class="wrapper table-responsive-sm">
        <h4>Update Category</h4>

        <br/>

        <?php

            if(isset($_GET['id'])) 
            {
                $id = $_GET['id'];

                //create sql query all data of select ID
                $sql = "SELECT * FROM tbl_category WHERE id='$id'";
                $updateCategory = mysqli_query($conn , $sql);

                $count = mysqli_num_rows($updateCategory);
                if($count == 1)
                    {
                        $row = mysqli_fetch_assoc($updateCategory);

                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                    }else
                        {
                            $_SESSION['no-category-found']="<div class='error'> Category not Found. </div>";
                            header('location:'.$SITEURl.'manage-category.php');
                        }

            }else
                {
                    header('location:'.$SITEURl.'manage-category.php');
                }


        ?>


        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl_third table table-striped table-hover mt-5 mb-5" >
                <tr>
                    <td>Title :-</td>
                    <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image :- </td>
                    <td>
                        <?php 
                                if($current_image !="")
                                    {
                                        ?>
                                        <img src="<?php echo $SITEURl; ?>../images/<?php echo $current_image; ?> " width='150px'>
                                        <?php
                                        
                                    }else
                                    {
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
                        Featured :-
                    </td>
                    <td>
                    <input <?php if($featured =='Yes'){ echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured =='No'){ echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :-</td>
                    <td>
                        <input <?php if($active =='Yes'){ echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active =='No'){ echo "checked";} ?> type="radio" name="active" value="No"> No
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
            if(isset($_POST['submit'])) :?>
                <?php
                    {
                        //1. Get the values
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $current_image = $_POST['current_image'];
                        $featured =$_POST['featured'];
                        $active =$_POST['active'];

                        //2. updating new image if select 
                        if(isset($_FILES['image']['name']))
                            {
                                $image_name =$_FILES['image']['name'];
                                if($image_name != "")
                                {
                                    //upload new image and remove old image
                                    $ext = end(explode('.',$image_name));
                                    $image_name = "Food_Category".rand(000,999).'.'.$ext;
                                    $source_p = $_FILES['image']['tmp_name'];

                                    $destination_path="../images/".$image_name;

                                    $upload = move_uploaded_file($source_p , $destination_path);
                                    
                                    if($upload == false)
                                    {
                                        $_SESSION['upload'] = "<div class='error'> Failed to upload image. </div>";
                                        header('location:'.$SITEURl.'manage-category.php');
                                        die();
                                    }

                                    //remove  current image
                                    if($current_image !="")
                                            {
                                                 $remove_path = "../images/".$current_image;
                                                 $removed = unlink($remove_path);

                                                 if($removed ==false)
                                                    {
                                                        $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image. </div>";
                                                        header('location:'.$SITEURl.'manage-category.php');
                                                        die(); //stop process
                                                }
                                            }
                                      
                                }else
                                {
                                    $image_name = $current_image;
                                }

                            }else
                                {
                                    $image_name= $current_image;
                                }


                        //3 update database & redirect category image

                        $sql2 = "UPDATE tbl_category SET title = '$title',image_name ='$image_name' ,featured='$featured', active = '$active' WHERE id = $id ";

                        $res2 = mysqli_query($conn, $sql2);

                        if($res2 == TRUE)
                        {
                            $_SESSION['update'] = "<div class='success'> Category Update Successfuly. </div>";
                            header("location:".$SITEURl.'manage-category.php');
                        }else
                            {
                            $_SESSION['update'] = "<div class='error'> Category Update Failed !!!. </div>";
                            header("location:".$SITEURl.'manage-category.php');
                            }

                        

                        
                    }


                ?>
            <?php endif ;?>


    </div>
</div>


<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>
