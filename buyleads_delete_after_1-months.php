<?php


include_once "include1/header.php";


// form 1

include "config.php";


?>
<!-- page content -->
<div class="container-fluid" role="main">
    <div class="row my-3">
        <div class="col-12">
            <h3 class="my-5">Hot Buyleads</h3>
        </div>
        <div class="col-12 my-3 ">
            <div class="row">
                <?php
                $user_email =  $_SESSION["user_email"];

                $sn = 1;
                $sql = "SELECT * FROM `hot_buyleads` where `user_email`='$user_email' limit 5";
                $query = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($query)) {


                ?>
                    <div class="col-lg-9 my-4">
                        <div class="buyleads_cards p-3 shadow-lg bg-white rounded border-start border-dark text-capitalize" style=" ">
                            <!--<h6>Product Name : ?php echo $product_name ?></h6>-->
                            <h5 class=" " style="color :#2f3394;font-weight: bold;"><?php echo $row['queiry_for'] ?> <img src="trusted.png" alt="" height="auto" width="10%"> </h5>
                            <ul class="nav justify-content-between">
                                <li class="nav-item" title="<?php echo $row['country_name'] ?>"> <i class="fa-solid fa-location-dot " style="color: #3fb635;margin-right:10px"></i> <?php echo $row['country_name'] ?> </li>
                                <li class="nav-item"><?php echo $row['accessed_at'] ?></li>
                            </ul>
                            <div class="row  mt-3 table-borderless">
                                <div class="col-lg-6  ">
                                    <div class="row   text-capitalize">
                                        <div class="col-6">
                                            <p class="m-0 p-0" style="color: #055faf;"><b>Buyer Name : </b></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="m-0 p-0 text-dark"> <?php echo $row['buyer_name'] ?> </p>
                                        </div>
                                    </div>
                                    <div class="row   text-capitalize">
                                        <div class="col-6">
                                            <p class="m-0 p-0" style="color: #055faf;"><b>Quantity : </b></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="m-0 p-0 text-dark"> <?php echo $row['quantity'] ?> </p>
                                        </div>
                                    </div>
                                    <div class="row   text-capitalize">
                                        <div class="col-6">
                                            <p class="m-0 p-0" style="color: #055faf;"><b>Mode Of Payment: </b></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="m-0 p-0 text-dark"> <?php echo $row['payment_mode'] ?> </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row   text-capitalize">
                                        <div class="col-6">
                                            <p class="m-0 p-0 " style="color: #055faf;"><b>Mobile Number : </b></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="m-0 p-0 text-dark"> +91-99*********00 </p>
                                        </div>
                                    </div>
                                    <div class="row   text-capitalize">
                                        <div class="col-6">
                                            <p class="m-0 p-0" style="color: #055faf;"><b>Buyer Email : </b></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="m-0 p-0 text-dark">***@gmail.com </p>
                                        </div>
                                    </div>
                                    <div class="row   text-capitalize">
                                        <div class="col-6">
                                            <p class="m-0 p-0" style="color: #055faf;"><b>Shipping Mode: </b></p>
                                        </div>
                                        <div class="col-6">
                                            <p class="m-0 p-0 text-dark"> <?php echo $row['shipping_mode'] ?> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if ($sn == '5') {
                            echo "
                             <div class='alert alert-primary'>
                                  <h4>You have used up your monthly limit !!</h4>
                            </div>
                            ";
                        }
                        ?>
                    </div>
                <?php $sn++;
                } ?>
            </div>
        </div>
    </div>
</div>



<?php
 
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "growindia";

$con = new mysqli($servername, $username, $password, $dbname);
$sql = "DELETE FROM  `hot_buyleads` WHERE accessed_at < NOW() - INTERVAL 1 MONTH";

if ($con->query($sql) === TRUE) {
    echo "Old records removed successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

 
?>


<!-- /page content -->
<?php
include_once "include1/footer.php";
// include "include1/footer.php";
?>