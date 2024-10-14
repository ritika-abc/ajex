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
    <input type="text" id="search" placeholder="Search..."> <br>
    <select id="search-results">
        <option value=""></option>
    </select>

    <script>
        $(document).ready(function(){
            $('#search').keyup(function(){
                var query = $(this).val();

                // Perform AJAX request
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {query: query},
                    success: function(response){
                        $('#search-results').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
 
