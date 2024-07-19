<?php
// Assuming you connect to your database here


$con = mysqli_connect("localhost","root","","b2b_new_project");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $query = $_POST['query'];
  $queiry_for = $_POST['queiry_for'];
  
  // Perform your search query here based on $query and $category
  // Example: Execute a SQL query using PDO or mysqli
  
  // Example using PDO (replace with your actual query logic):
  $stmt = $pdo->prepare("SELECT * FROM buyleads WHERE queiry_for = :query");
  $stmt->execute(['queiry_for' => $category, 'query' => "%$query%"]);
  
  // Example: Fetch and display results
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  foreach ($results as $result) {
    echo '<div class="result">';
    echo '<h3>' . $result['title'] . '</h3>';
    echo '<p>' . $result['description'] . '</p>';
    echo '</div>';
  }
}
?>
