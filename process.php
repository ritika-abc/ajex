<?php
// process.php

// Check if the POST request contains data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the data sent from the form
    $textareaData = $_POST['textareaData'] ?? '';
    $tableData = $_POST['tableData'] ?? '';

    // Perform database operations or other processing
    // Example: Print the data to verify
    echo 'Textarea Data: <br>' . htmlspecialchars($textareaData) . '<br><br>';
    echo 'Table Data: <br>' . htmlspecialchars($tableData) . '<br>';

    // To insert into a database, you would typically use PDO or mysqli
    // Example using PDO (adjust database credentials and table structure accordingly):
    /*
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Example: Insert table data into a database
        $stmt = $pdo->prepare('INSERT INTO your_table (column1, column2) VALUES (?, ?)');
        // Bind values here and execute
        $stmt->execute([$value1, $value2]);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    */
} else {
    echo 'Invalid request method.';
}
?>
