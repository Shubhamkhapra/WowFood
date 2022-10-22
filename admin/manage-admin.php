
<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>

<!-- Main Content section starts -->
<div class="main-content" style="height:80vh">
     <h4>Manage Admin</h4>
    <div class="wrapper table-responsive-sm">
       
        <br/>

        <?php 
                //Add Admin user successful or not message
                if (isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); //remove session message 
                }

                //Delete user successful or not message 
                if (isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']); 
                }

                // Update user successful or not message
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);  
                }

                //user not found error message
                if (isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']); 
                }

                //user update  password not match message
                if (isset($_SESSION['pwd-not-match'])) {
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']); 
                }


                //user Password successful change message
                if (isset($_SESSION['pwd-change'])) {
                    echo $_SESSION['pwd-change'];
                    unset($_SESSION['pwd-change']); 
                }
                
        ?>
        <br/><br>

        <!-- Button  To Add Admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br/><br/>

        <table class="tbl_full table table-striped table-hover mt-5 mb-5 ">
        	<tr>
        		<th>S.No</th>
        		<th>Full Name</th>
        		<th>Username</th>
        		<th>Action</th>
        	</tr>

            <?php  
                    // query to get all admin
                    $sql= "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn, $sql);

                    //check whether quey is excuted or not

                    if ($res == TRUE ){
                         //count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($res);
                        $sn =1;

                        if ($count > 0)

                        {       
                            while ($rows=mysqli_fetch_assoc($res)) {
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                            ?>
                                <tr>
                                    <td> <?php echo $sn++; ?> </td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo $SITEURl ; ?>update-admin.php?id=<?php echo $id; ?>" class="text-warning" > <span class="material-symbols-outlined">edit </span> </a>
                                        <a href="<?php echo $SITEURl ; ?>update-password.php?id=<?php echo $id; ?>" class="text-info" > <span class="material-symbols-outlined">lock </span> </a>
                                        <a href="<?php echo $SITEURl ; ?>delete-admin.php?id=<?php echo $id; ?>" class="text-danger"> <span class="material-symbols-outlined">
                                delete
                                </span></a>

                                    </td>
                                </tr>
                            <?php 

                            }

                        }else
                            {
                                echo '<script>alert("No Admin User found & you can add Admin ")</script>';         
                            }

                     } else
                        {
                            echo '<script>alert("Database Table Connection Error!")</script>';
                        }

            ?> 

        </table>

    </div>
</div>
<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>