<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'growindia';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product from the GET request
$product = isset($_GET['product']) ? $_GET['product'] : '';

// Query to fetch buy leads
$sql = "SELECT * FROM  buyleads";
if ($product != '') {
    $sql .= " WHERE queiry_for = '$product'";
}

$result = $conn->query($sql);

// Fetch results and output them in HTML
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='lead'>";
        echo "<h3>" . $row['queiry_for'] . "</h3>";
    
        echo "</div>";
    }
} else {
    echo "No leads found.";
}

$conn->close();
?>
