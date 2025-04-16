<?php
if (isset($_POST['update']) && isset($_FILES['new_image'])) {
    $conn = new mysqli('localhost', 'root', '', 'multiimage');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $imageId = $_POST['image_id'];
    $image = $_FILES['new_image'];

    if ($image['error'] === 0) {
        $newName = uniqid('', true) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
        $uploadPath = 'uploads/' . $newName;

        if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
            // Get old image path to delete the file
            $oldImage = $conn->query("SELECT image_path FROM images WHERE id = $imageId")->fetch_assoc();
            if (file_exists($oldImage['image_path'])) {
                unlink($oldImage['image_path']); // delete old image file
            }

            // Update DB
            $sql = "UPDATE images SET image_name = '$newName', image_path = '$uploadPath' WHERE id = $imageId";
            $conn->query($sql);
        }
    }

    $conn->close();
    header("Location: update.php");
    exit();
}
?>
