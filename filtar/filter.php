<?php
// Connect to MySQL database
$conn = new mysqli("localhost", "root", "", "filtar");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the raw JSON input and decode it
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize and assign inputs
$price = isset($data['price']) ? (int)$data['price'] : 0;
$colors = isset($data['colors']) ? $data['colors'] : [];
$availability = isset($data['availability']) && $data['availability'] === 'in_stock' ? 1 : 0;

// Start building SQL query
$sql = "SELECT * FROM products WHERE price <= $price";

// Handle color filters
if (!empty($colors)) {
    // Escape each color safely using mysqli_real_escape_string and the $conn object
    $escapedColors = array_map(function($color) use ($conn) {
        return mysqli_real_escape_string($conn, $color);
    }, $colors);

    // Convert to quoted string values for SQL IN clause
    $colorList = "'" . implode("','", $escapedColors) . "'";
    $sql .= " AND color IN ($colorList)";
}

// Handle availability
$sql .= " AND in_stock = $availability";

// Run the query
$result = $conn->query($sql);

// Output product results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product'>";
        echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
        echo "<p>Price: $" . htmlspecialchars($row['price']) . "</p>";
        echo "<p>Color: " . htmlspecialchars($row['color']) . "</p>";
        echo "<p>" . ($row['in_stock'] ? "In Stock" : "Out of Stock") . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No products found matching your criteria.</p>";
}
0
// Close DB connection
$conn->close();
?>
