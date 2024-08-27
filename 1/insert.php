<!-- insert.php -->
<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "test_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the input values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $values = $_POST['values'];
    // Remove extra spaces
    $values = array_map('trim', $values);

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert into main table
        $stmt = $conn->prepare("INSERT INTO main_table (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        $name = "Sample Name"; // Example name or could be another field
        $stmt->execute();
        $main_id = $stmt->insert_id; // Get the last inserted ID

        // Insert into related table
        $stmt = $conn->prepare("INSERT INTO values_table (main_id, value) VALUES (?, ?)");
        foreach ($values as $value) {
            $stmt->bind_param("is", $main_id, $value);
            $stmt->execute();
        }

        // Commit transaction
        $conn->commit();
        echo "New records created successfully";

    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
