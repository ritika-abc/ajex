<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rating";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$item_id = $_POST['item_id'];
$user_id = $_POST['user_id'];
$rating = $_POST['rating'];

// Check if the user has already rated this item
$sql = "SELECT * FROM ratings WHERE item_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $item_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update existing rating
    $sql = "UPDATE ratings SET rating = ? WHERE item_id = ? AND user_id = ?";
} else {
    // Insert new rating
    $sql = "INSERT INTO ratings (item_id, user_id, rating) VALUES (?, ?, ?)";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $rating, $item_id, $user_id);
$stmt->execute();

$stmt->close();
$conn->close();

echo json_encode(["status" => "success"]);
?>
