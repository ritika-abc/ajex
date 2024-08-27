<?php
include "config.php"; // Include your database connection

// Query to select data from the 'products' table
$sql = "SELECT product_id, product_name, price, description FROM products";
$result = $con->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    echo '<div class="container">';
    echo '<div class="row">';
    
    // Fetch and display the data
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 my-3">';
        echo '<div class="card" style="width: 18rem;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['product_name']) . '</h5>';
        echo '<h6 class="card-subtitle mb-2 text-muted">Price: $' . htmlspecialchars($row['price']) . '</h6>';
        echo '<p class="card-text">' . htmlspecialchars($row['description']) . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</div>';
} else {
    echo "<p>No results found</p>";
}

// Close the database connection
$con->close();
?>
