<?php
$conn = new mysqli('localhost', 'root', '', 'multiimage');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="' . $row['image_path'] . '" alt="' . $row['image_name'] . '">';
        echo '<p>' . $row['image_name'] . '</p>';
        echo '</div>';
    }
} else {
    echo 'No images found.';
}

$conn->close();
?>
