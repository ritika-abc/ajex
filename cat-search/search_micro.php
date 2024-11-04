<?php
$con = mysqli_connect("localhost", "root", "", "b2b_new_project");

if (isset($_POST['query'])  ) {
    $search = $_POST['query'];
   

    // Perform SQL query to fetch matching micro-categories
    $sql = "SELECT * FROM `micro` WHERE micro_name LIKE '%$search%' ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['micro_id'] . '">' . $row['micro_name'] . '</option>';
        }
    } else {
        echo '<option>No results found</option>';
    }
}
?>
