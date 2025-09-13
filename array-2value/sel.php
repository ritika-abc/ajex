<?php
// Display stored key-value pairs
$sql = "SELECT * FROM key_value_pairs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Stored Key-Value Pairs:</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>Key:</strong> " . $row["key_name"] . " | <strong>Value:</strong> " . $row["value_name"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No key-value pairs found.";
}
