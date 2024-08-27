<?php
// Initialize your database connection here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "b2b_new_project";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchType = $_POST['searchType'];
    $query = $_POST['query'];
    
    // Perform your search query based on $searchType and $query
    // Example: Execute a SQL query using PDO
    
    if ($searchType === 'buyleads') {
        $stmt = $pdo->prepare("SELECT * FROM buyleads WHERE queiry_for LIKE :query");
    } else if ($searchType === 'product') {
        $stmt = $pdo->prepare("SELECT * FROM product WHERE product_name LIKE :query");
    } else {
        die("Invalid search type");
    }
    
    $stmt->execute(['query' => "%$query%"]);
    
    // Fetch and display results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($searchType === 'buyleads'){
        if ($results) {
            foreach ($results as $result) {
                echo '<div class="result">';
                echo '<h3>' . htmlspecialchars($result['queiry_for']) . '</h3>';
            
                echo '</div>';
            }
        } else {
            echo '<p>No results found.</p>';
        }
    }else if($searchType === 'product'){
        if ($results) {
            foreach ($results as $result) {
                echo '<div class="result">';
                echo '<h3>' . htmlspecialchars($result['product_name']) . '</h3>';
            
                echo '</div>';
            }
        } else {
            echo '<p>No results found.</p>';
        }
    }
   
}
?>
