<!-- select.php -->
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

// Query to select data with JOIN
$sql = "
    SELECT main_table.main_id , main_table.name, values_table.value 
    FROM main_table 
    LEFT JOIN values_table ON main_table.main_id  = values_table.main_id
";
$result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     $current_id = null;
//     while ($row = $result->fetch_assoc()) {
//        echo  $row['value'];

//     }
// } else {
//     echo "0 results";
// }

while ($row = mysqli_fetch_array($result)) {
   echo $val = $row['value'];
}
// Close connection
$conn->close();
?>
<h1> 
<?php echo $val ?>

</h1>
<?php

$inp = array('val1'=>'apple','val2'=>'mango');

?>