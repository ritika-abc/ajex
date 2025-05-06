<?php
// Check if form is submitted
if (isset($_POST['submit'])) {

    include "config.php";
    // Check if files are uploaded
    if (isset($_FILES['image']['name']) && count($_FILES['image']['name']) > 0) {

        // Prepare an array to store file names
        $image_list = array();

        // Loop through each file
        for ($i = 0; $i < count($_FILES['image']['name']); $i++) {

            $file_name = $_FILES['image']['name'][$i];
            $temp_name = $_FILES['image']['tmp_name'][$i];

            // Check if file is uploaded successfully
            if (move_uploaded_file($temp_name, 'upload/' . $file_name)) {
                // Store file name in array
                $image_list[] = 'upload/' . $file_name; // Adjust path as per your setup
            }
        }

        // Insert into database
        if (!empty($image_list)) {
            // Serialize or JSON encode $image_list as per your preferred method
            $image_data = json_encode($image_list);
            $name = $_POST['name'];
            $price = $_POST['price'];
            // Insert query
            $sql = "INSERT INTO  `product`(`image`,`name`,`price`) VALUES (?,?,?)";

            // Prepare statement
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $image_data, $name,$price);

            // Execute statement
            if ($stmt->execute()) {
                echo "Images uploaded and inserted successfully.";
            } else {
                echo "Error inserting images: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        }
    } else {
        echo "No images uploaded.";
    }

    // Close connection
    $con->close();
}
