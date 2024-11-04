
<?php
$con = mysqli_connect("localhost","root","","b2b_new_project");
?>


<?php
// Include your database connection file
 

if(isset($_POST['query'])) {
    $search = $_POST['query'];

    // Perform SQL query to fetch matching results
    $sql = "SELECT * FROM `category` WHERE cat_name LIKE '%$search%'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '<option value=' .  $row['cat_id'] .'>' . $row['cat_name'] . '</option>';
        }
    } else {
        echo '<option>No results found</option>';
    }
}
?>
