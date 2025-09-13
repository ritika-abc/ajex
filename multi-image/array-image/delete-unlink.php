<?php
include "config.php";

$id = $_GET['id'];
$select = "SELECT * from `product`  WHERE `id`='$id' ";
$query = mysqli_query($con, $select);

if ($query && mysqli_num_rows($query) > 0) {
    // Fetch the row containing the image path
    $row = mysqli_fetch_assoc($query);
    $image_path = $row['image'];  // Assuming the image is stored as a JSON string (if multiple images)

    // If there are multiple images, decode them into an array
    $image_list = json_decode($image_path, true);

    // Delete the images from the folder
    if (!empty($image_list)) {
        foreach ($image_list as $image) {
            if (file_exists($image)) {
                unlink($image);  // Delete the image from the server
            }
        }
    }
}






$del = "DELETE FROM `product` WHERE `id`='$id'";
$query = mysqli_query($con, $del);

if ($query) {
   
    header("location:view-product.php");
}
