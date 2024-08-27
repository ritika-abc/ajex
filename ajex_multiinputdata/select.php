<?php
 
$host = "localhost";
$user = "root";
$pass = "";
$db = "my_database";

// Create connection
// $conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Query to get data from the table
$sql = "SELECT * FROM services";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Table</title>
</head>
<body>
    <h1>Service Table</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Product</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <?php
                // Split the services into an array
                $services = explode(',', $row['service']);
                // Get the first three services
                $firstThreeServices = array_slice($services, 0, 3);
                // Convert the array back to a string
                $servicesString = implode(', ', $firstThreeServices);
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['product']); ?></td>
                    <td><?php echo htmlspecialchars($servicesString); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
