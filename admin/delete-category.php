<?php
ob_start();
?>
<!-- Main Content section starts -->
<?php
    include('../config/constants.php'); 
    //1. Get the ID of admin to be Deleted
   if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name !="")
            {
                $path = "../images/".$image_name;
                $remove = unlink($path);

                if($remove == false)
                    {
                        $_SESSION['remove']= "<div class='error'>  <?php  echo 'Failed to Remove Category Image!'; ?> </div> '";
                        header('location: '.$SITEURL.'admin/manage-category.php');
                        die();
                    }
            }
        
        //2. Create SQl query to Delete Admin
        $queryDelete = "DELETE FROM tbl_category WHERE id=$id";
        $qApply = mysqli_query($conn, $queryDelete);

            //check query excute or not
            if($qApply ==true)
            {
                $_SESSION['delete'] = "<div class='success'> Delete Category Successful </div>";
                header('location: '.$SITEURL.'admin/manage-category.php');
                ob_end_flush();

                // echo '<script> alert(" Delete Admin Successful") </script>' ;
                // echo "success";
            }else
            {
                $_SESSION['delete']= "<div class='error'>  <?php  echo 'Fail to  Delete Category!'; ?> </div> '";
                header('location: '.$SITEURL.'admin/manage-category.php');ob_end_flush();

                // echo '<script> alert("Fail to  Delete Admin! ") </script>' ;
                // echo "fail";
            }
        
        
    }else
        {
            header('location: '.$SITEURL.'admin/manage-category.php');ob_end_flush();

        }

    
   
    

?>
<!-- Main Content section End -->