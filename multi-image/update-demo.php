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
            if ($conn->query($sql)) {
                header("Location: update.php?id=$imageId"); // Redirect to the update page after success
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }

    $conn->close();
}
?>



<div class="container">
    <h2>Update Image</h2>

    <p>Current Image:</p>
    <img class="image-preview" src="<?php echo $image['image_path']; ?>" alt="Current Image">
    
    <form action="update_image.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">

        <div class="form-group">
            <label for="new_image">Choose a new image:</label>
            <input type="file" name="new_image" id="new_image" required>
        </div>

        <button type="submit" name="update" value="Update">Update Image</button>
    </form>
</div>