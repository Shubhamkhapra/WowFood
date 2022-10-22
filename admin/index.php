<!-- Menu ADD -->
<?php include('partials/menu.php'); ?>
<?php ob_start();?>
<?php

	if(isset($_SESSION['user'])){
	    echo "null";
	    $check = $_SESSION['user'];
	    if($check == ""){
	        echo "null1";
	        header("location:".$SITEURl.'index.php');
	        ob_end_flush();
	    }
	}

			?>

<!-- Main Content section starts -->
<div class="main-content" style="height:100vh;">
    <h4>DASHBOARD</h4>
    <div class="wrapper d-flex justify-content-center flex-wrap">
        

        <?php if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <br> <br>

        <div class="col-4 text-center">
            <?php 

             $sql = "SELECT * FROM tbl_category";
             $res = mysqli_query($conn , $sql);
             $count = mysqli_num_rows($res);


            ?>
            <h1><?php echo $count ; ?></h1> <br />
            Categories
        </div>

        <div class="col-4 text-center">
            <?php 

                $sql1 = "SELECT * FROM tbl_food";
                $res1 = mysqli_query($conn , $sql1);
                $count1 = mysqli_num_rows($res1);


            ?>
            <h1><?php echo $count1 ; ?></h1> <br />
            Foods
        </div>

        <div class="col-4 text-center">
            <?php 

                $sql2 = "SELECT * FROM tbl_order";
                $res2 = mysqli_query($conn , $sql2);
                $count2 = mysqli_num_rows($res2);


            ?>
            <h1><?php echo $count2 ; ?></h1> <br />
            Total Orders
        </div>

        <div class="col-4 text-center">
            <?php 

                $sql3 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                $res3 = mysqli_query($conn , $sql3);
                $row3 = mysqli_fetch_assoc($res3);
                $total_revenue=$row3['Total'];


            ?>
            <h1>&#8377;<?php echo $total_revenue ; ?></h1> <br />
            <h3>Revenue Generated </h3>
        </div>
        
        <div class="clearfix"></div>

    </div>
</div>
<!-- Main Content section End -->

<!-- Footer Add -->
<?php include('partials/footer.php'); ?>