<?php
$con = mysqli_connect("localhost", "root", "", "arv");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $cat_name = $_POST['cat_name'];
    $slug =  $_POST['slug'];
    $transformed_input = strtolower(str_replace(" ", "-", $cat_name));

    $_FILES["image"]["name"];

    $image =  time() . "_" . $_FILES["image"]["name"];
    $fld1 = "image/product/" . $image;

    // Move the uploaded file to the desired folder
    move_uploaded_file($_FILES["image"]["tmp_name"], $fld1);


    $insert = "INSERT INTO `product`(`name`,`cat_name`,`image`,`slug`) VALUES ('$name','$cat_name','$fld1','$transformed_input')";
    $q = mysqli_query($con, $insert);
    if ($q) {
        header("location:ins.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Fashion Premium Event Fashion Store -Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/vendor.css">
    <script src="assets/js/jquery.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    include_once "nav.php";

    ?>


    <div class="container ">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="my-5">
                <input type="text" placeholder="Product Name" name="name" class="form-control">
            </div>
            <div class="my-5">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="my-5">
                <input type="text" name="slug" class="form-control">
            </div>
            <div class="my-5">
                <select name="cat_name" class="form-select" id="">
                    <option value="">select</option>

                    <?php

                    $con = mysqli_connect("localhost", "root", "", "arv");
                    $sel = "SELECT * FROM `cat`";
                    $q = mysqli_query($con, $sel);
                    while ($row = mysqli_fetch_array($q)) {
                        $cat_name = $row['cat_name'];
                    }

                    ?>
                    <option value="<?php echo $cat_name ?>"><?php echo $cat_name ?></option>

                </select>
            </div>
            <div class="my-5">
                <input type="submit" name="submit" class="btn btn-danger">
            </div>
        </form>
    </div>









    <?php
    include_once "footer.php";

    ?>