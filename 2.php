<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 10px;
        }
        p {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Search Results</h2>
        
        <?php
        // Retrieve search parameters from URL
        $con = mysqli_connect("localhost", "root", "", "b2b_new_project");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $searchType = $_GET['searchType'];
        $query = $_GET['query'];

        // Output the received data (for testing purposes)
        echo "<p>Search Type: $searchType</p>";
        echo "<p>Query: $query</p>";

        // Prepare and execute SQL query based on search type
        if ($searchType === 'buyleads') {
            $sql = "SELECT * FROM buyleads WHERE queiry_for LIKE ?";
        } elseif ($searchType === 'product') {
            $sql = "SELECT * FROM product WHERE product_name LIKE ?";
        } else {
            echo "<p>No valid search type specified.</p>";
            exit; // Stop further execution if no valid search type
        }

        // Prepare statement
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt === false) {
            die('MySQL prepare error: ' . mysqli_error($con));
        }

        // Bind parameters and execute statement
        $param = "%$query%";
        mysqli_stmt_bind_param($stmt, "s", $param);
        mysqli_stmt_execute($stmt);

        // Process result set
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($searchType === 'buyleads') {
                echo "<h1>" . htmlspecialchars($row['queiry_for']) . "</h1>";
            } elseif ($searchType === 'product') {
                echo "<h1>" . htmlspecialchars($row['product_name']) . "</h1>";
            }
        }

        // Close statement and database connection
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        ?>
        
    </div>
</body>

</html>
