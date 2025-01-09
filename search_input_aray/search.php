<?php
$host = 'localhost';
$dbname = 'growindia';
$username = 'root';
$password = '';

// Create a PDO instance for database connection
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Get the search term
$searchTerm = isset($_GET['search']) ? strtolower($_GET['search']) : '';

if (!empty($searchTerm)) {
    // Prepare the query to search products
    $stmt = $pdo->prepare("SELECT * FROM user WHERE LOWER(item3) LIKE :searchTerm");
    $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);

    // Fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<h2>Search Results:</h2>";
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li>" . ucfirst($row['item3']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No products found for '$searchTerm'.</p>";
    }
} else {
    echo "<p>Please enter a search term.</p>";
}
?>
