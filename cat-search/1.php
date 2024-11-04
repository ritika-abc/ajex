<?php
$con = mysqli_connect("localhost", "root", "", "b2b_new_project");

if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $cat_id = $_POST['cat_id']; // Get the selected category ID
    $ins = "INSERT INTO `product`(`cat_id`, `product_name`) VALUES ('$cat_id', '$product_name')";
    $qe = mysqli_query($con, $ins);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* Optional: Add some basic styling */
        #search-results {
            list-style-type: none;
            padding: 0;
        }

        #search-results li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }

        #search-results li:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h2>Live Search Example</h2>
    <form action="" method="post">
        <input type="text" id="search" placeholder="Search..."> <br>
        <input type="text" id="sub-search" placeholder="sub-search..."> <br>
        <input type="text" id="inner-search" placeholder="inner-search..."> <br>
        <input type="text" id="micro-search" placeholder="micro-search..."> <br>
        <hr>
        <input type="text" name="product_name" placeholder="Product Name..." required> <br>
        <select id="search-results" name="cat_id">
            <option value="">Select a category</option>
        </select>
    
        <select id="sub-results" name=" ">
            <option value="">Select a sub category</option>
        </select>
        <select id="inner-results" name=" ">
            <option value="">Select a inner category</option>
        </select>
            <select id="micro-results" name=" ">
            <option value="">Select a  category</option>
        </select>
        <input type="submit" name="submit" value="Add Product">
    </form>

    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                var query = $(this).val();

                // Perform AJAX request
                $.ajax({
                    url: 'search-cat.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('#search-results').html(response);
                    }
                });
            });


            // sub category
            $('#sub-search').keyup(function() {
                var query = $(this).val();
                var catId = $('#search-results').val(); // Get the selected category ID
                // alert(catId1)
                if (catId) {
                    $.ajax({
                        url: 'search-sub.php',
                        method: 'POST',
                        data: {
                            query: query,
                            cat_id: catId
                        },
                        success: function(response) {
                            $('#sub-results').html(response);
                        }
                    });
                } else {
                    $('#search-results').html('<option value="">Select a sub category</option>');
                }
            });


              // Micro-category search
              $('#inner-search').keyup(function() {
                var query = $(this).val();
                var catId = $('#search-results').val(); // Get the selected category ID
                // alert(catId)
                if (catId) {
                    $.ajax({
                        url: 'search_inner.php',
                        method: 'POST',
                        data: { query: query, cat_id: catId },
                        success: function(response) {
                            $('#inner-results').html(response);
                        }
                    });
                } else {
                    $('#inner-results').html('<option value="">Select a micro category</option>');
                }
            });
              // Micro-category search
              $('#micro-search').keyup(function() {
                var query = $(this).val();
                var catId = $('#search-results').val(); // Get the selected category ID
                // alert(catId)
                if (catId) {
                    $.ajax({
                        url: 'search_micro.php',
                        method: 'POST',
                        data: { query: query, cat_id: catId },
                        success: function(response) {
                            $('#micro-results').html(response);
                        }
                    });
                } else {
                    $('#micro-results').html('<option value="">Select a micro category</option>');
                }
            });

        });
    </script>
</body>

</html>