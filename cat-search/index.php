
<?php
$con = mysqli_connect("localhost","root","","b2b_new_project");
if(isset($_POST['submit'])){
$product_name = $_POST['product_name'];
$cat_id = $_POST['cat_id'];
$ins = "insert into `product`(`cat_id`,`product_name`) VALUES ('$cat_id','$product_name')";
$qe = mysqli_query($con,$ins);
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
        <input type="text" name="product_name"  placeholder="product_name..."> <br>
        <select id="search-results" name=" ">
            <option value=""></option>
        </select>
        <input type="submit" name="submit">
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
        });
    </script>
</body>

</html>