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

$item_id = $_GET['item_id'];

$sql = "SELECT AVG(rating) as average_rating FROM ratings WHERE item_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $item_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$stmt->close();
$conn->close();

echo json_encode(["average_rating" => $data['average_rating']]);
?>
