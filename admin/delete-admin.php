<?php
ob_start();
?>
<!-- Main Content section starts -->
<?php
    include('../config/constants.php'); 
    //1. Get the ID of admin to be Deleted
    $id = $_GET['id'];

    //2. Create SQl query to Delete Admin
    $queryDelete = "DELETE FROM tbl_admin WHERE id=$id";
    $qApply = mysqli_query($conn, $queryDelete);

    //check query excute or not
    if($qApply ==true)
        {
            $_SESSION['delete'] = "<div class='success'> Delete Admin Successful </div>";
            // header('location: '.$SITEURL.'./manage-admin.php');
            header('location: '.$SITEURL.'admin/manage-admin.php');
            ob_end_flush();
            // echo '<script> alert(" Delete Admin Successful") </script>' ;
            // echo "success";
        }else
        {
            $_SESSION['delete']= "<div class='error'>  <?php  echo 'Fail to  Delete Admin!'; ?> </div> '";
            header('location: '.$SITEURL.'admin/manage-admin.php');
            ob_end_flush();
            // echo '<script> alert("Fail to  Delete Admin! ") </script>' ;
            // echo "fail";
        }
    //3. Redirect to manage admin page with message (success/error)
    

?>
<!-- Main Content section End -->
