<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $names = $_POST['name'];
    $descriptions = $_POST['description'];

    // Generate the SQL query for bulk insert
    $values = [];
    foreach ($names as $index => $name) {
        $description = $descriptions[$index];
        // Sanitize data to prevent SQL injection
        $name = $conn->real_escape_string($name);
        $description = $conn->real_escape_string($description);
        $values[] = "('$name', '$description')";
    }
    
    if (!empty($values)) {
        $sql = "INSERT INTO services (name, description) VALUES " . implode(', ', $values);
    
        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "New records created successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "No data submitted.";
    }

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
