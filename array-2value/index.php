
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Insert Key-Value</title>
</head>
<body>
    <h1>Enter Multiple Key-Value Pairs</h1>

    <!-- HTML Form to input multiple key-value pairs -->
    <form method="POST">
        <label for="key_value">Key-Value Pairs (e.g. key1:value1, key2:value2):</label><br>
        <textarea id="key_value" name="key_value" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "key_value_db"; // Replace with your database name

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key_value_input = $_POST['key_value']; // Get the key-value input

    // Split the input into individual key-value pairs
    $key_value_pairs = explode(',', $key_value_input); // Split by comma

    // Iterate through the pairs
    foreach ($key_value_pairs as $pair) {
        // Trim spaces and split the pair into key and value
        $pair = trim($pair);
        list($key, $value) = explode(":", $pair);

        // Insert each key-value pair into the database
        $sql = "INSERT INTO key_value_pairs (key_name, value_name) VALUES (?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $key, $value);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    echo "Key-value pairs inserted successfully!<br>";
}

// Display stored data in the desired format
$sql = "SELECT * FROM key_value_pairs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = [];
    while ($row = $result->fetch_assoc()) {
        // Store the key-value pairs as an associative array
        $output[] = $row["key_name"] . " : " . $row["value_name"];
    }

    // Format the output as a single string
    echo "<h2>Stored Key-Value Pairs:</h2>";
    echo "[" . implode(", ", $output) . "]";
} else {
    echo "No key-value pairs found.";
}

// Close the connection
$conn->close();
?>
    