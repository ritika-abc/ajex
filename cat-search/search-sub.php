<?php
$con = mysqli_connect("localhost", "root", "", "b2b_new_project");

if (isset($_POST['query']) && isset($_POST['cat_id'])) {
    $search = $_POST['query'];
    $cat_id = $_POST['cat_id']; // Get the selected category ID

    // Perform SQL query to fetch matching micro-categories
    $sql = "SELECT * FROM `sub_cat` WHERE sub_cat_name LIKE '%$search%' AND cat_id = '$cat_id'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['sub_id'] . '">' . $row['sub_cat_name'] . '</option>';
        }
    } else {
        echo '<option>No results found</option>';
    }
}
?>
