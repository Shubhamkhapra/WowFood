<?php
ob_start();
?>
<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content">
    <div class="wrapper table-responsive-sm">
        <h4>Update Admin</h4>

        <br/>
        <?php
            //1. Get the ID of select admin
            $id = $_GET['id'];

            //2. Create Sql query to get detail 
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $updated = mysqli_query($conn, $sql);

            //check query work or not
            if ($updated==true) 
                {
                    $count = mysqli_num_rows($updated);
                    if ($count==1)
                            {
                                $row = mysqli_fetch_assoc($updated);
                                $full_name = $row['full_name'];
                                $username = $row['username'];


                            }else
                                {
                                    header('location:'.$SITEURl.'manage-admin.php');
                                    ob_end_flush();
                                }
                }else
                    {
                        echo "Problem in Upadte-admin page!!!";
                    }
         ?>
        <form action="" method="POST">
            
            <table class="tbl_third table table-striped table-hover mt-5 mb-5">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td> UserName: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2"> <input type="submit" name="submit" value="Update Admin" class="btn-secondary"> </td>
                    
                </tr>

            </table>

        </form>


    </div>
</div>

<?php
    //check the submit button click or not
    if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            $updateQuery = "UPDATE tbl_admin SET full_name='$full_name', username='$username' WHERE id='$id'";
            $updateDB = mysqli_query($conn , $updateQuery);

            //check query work or not

            if($updateDB==TRUE)
                {
                   $_SESSION['update']= "<div class='sucess'> Admin Update Successfully.</div>";
                    header('location:'.$SITEURl.'manage-admin.php');
                    ob_end_flush();
                }else
                    {
                        $_SESSION['update']= "<div class='error'>Fail to Update Admin.</div>";
                         header('location:'.$SITEURl.'manage-admin.php');
                         ob_end_flush();

                    }
        }else
        {
           
        }
?>
<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>