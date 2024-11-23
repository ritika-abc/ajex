<?php
if (isset($_POST['submit']) && isset($_FILES['images'])) {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'multiimage');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Loop through the files and upload each one
    $images = $_FILES['images'];
    $imageCount = count($images['name']);

    for ($i = 0; $i < $imageCount; $i++) {
        $imageName = basename($images['name'][$i]);
        $imageTmpName = $images['tmp_name'][$i];
        $imageSize = $images['size'][$i];
        $imageError = $images['error'][$i];
        $imageType = $images['type'][$i];

        // Check for errors
        if ($imageError === 0) {
            // Generate a unique name for each image to avoid overwriting
            $imageNewName = uniqid('', true) . '.' . pathinfo($imageName, PATHINFO_EXTENSION);
            $imageUploadPath = 'uploads/' . $imageNewName;

            // Move the uploaded file to the desired folder
            if (move_uploaded_file($imageTmpName, $imageUploadPath)) {
                // Insert image information into the database
                $sql = "INSERT INTO images (image_name, image_path) VALUES ('$imageNewName', '$imageUploadPath')";
                $conn->query($sql);
            }
        }
    }

    // Close the database connection
    $conn->close();
    header("Location: index.php"); // Redirect back to the page
    exit();
}
?>
