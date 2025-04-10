<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image'];
    $imageName = basename($image['name']);
    $imageTmpPath = $image['tmp_name'];
    $imageSize = $image['size'];
    
    // Check if file is a JPG and at least 25KB
    if ($image['type'] !== 'image/jpeg') {
        echo "Only JPG files are allowed!";
    } elseif ($imageSize < 25000) {
        echo "Image size must be at least 25KB!";
    } else {
        // Move uploaded image to the uploads folder
        $uploadDir = 'uploads/';
        $uploadPath = $uploadDir . $imageName;
        
        if (move_uploaded_file($imageTmpPath, $uploadPath)) {
            // Save image info to the database
            $stmt = $pdo->prepare("INSERT INTO images (image_name, image_path) VALUES (?, ?)");
            $stmt->execute([$imageName, $uploadPath]);

            echo "Image uploaded successfully!";
            header('Location: index.php');
            exit;
        } else {
            echo "Error uploading file.";
        }
    }
}
?>

<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="image">Choose an image (JPG only, min 25KB):</label>
    <input type="file" name="image" id="image" required><br><br>
    <input type="submit" value="Upload">
</form>
