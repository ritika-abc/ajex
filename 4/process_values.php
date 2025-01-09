<?php
// Database connection credentials
$servername = "localhost";  // Your database server (localhost if running on the same server)
$username = "root";         // Your database username
$password = "";             // Your database password (leave empty for local setup)
$dbname = "test_db";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'values' data is sent via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['values']) && is_array($_POST['values'])) {
        $values = $_POST['values'];

        // Loop through the values array and insert each value into the database
        foreach ($values as $value) {
            // Sanitize input to prevent SQL injection
            $value = $conn->real_escape_string($value);

            // SQL query to insert the value into the table
            $sql = "INSERT INTO main_table (value) VALUES ('$value')";

            // Execute the query and check for success
            if ($conn->query($sql) === TRUE) {
                // Respond with success message
                echo json_encode(['status' => 'success', 'message' => 'Values inserted successfully']);
            } else {
                // Respond with an error message if something goes wrong
                echo json_encode(['status' => 'error', 'message' => 'Error inserting value: ' . $conn->error]);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No values received']);
    }
}

// Close the connection
$conn->close();
?>
