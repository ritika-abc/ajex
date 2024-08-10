<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-5 ">
                <form action=" " class="mobile-search hidedesktop  ajex_search border  " id="liveSearchForm">

                    <select id="searchType" class="border-end   border-secondary" required>
                        <option value="buyleads">Buyleads</option>
                        <option value="product">Products</option>
                    </select>
                    <input type="search" class=" form-control" name="query" id="searchQuery" placeholder="Search..." required>
                    <button   class="  " type="submit"><i class="icon-search"></i> Search</button>
                </form>
            </div>
        </div>
    </div>


    <style>
        .ajex_search input,
        select {
            border: none;
            padding: 10px;
        }

        .ajex_search input:focus,
        select:focus {
            outline: none;
        }

        .ajex_search {
            border: 1px solid red;
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
        }

        .ajex_search button {
            background-color: ;
            padding: 10px;
            border: none;
            background-color: gray;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#liveSearchForm').submit(function(e) {
                e.preventDefault(); // Prevent form submission

                var searchType = $('#searchType').val();
                var query = $('#searchQuery').val();

                $.ajax({
                    url: 'search1.php', // PHP script handling the search
                    type: 'POST',
                    data: {
                        searchType: searchType,
                        query: query
                    },
                    success: function(response) {
                        $('#searchResults').html(response); // Display search results
                        // window.location.href = '2.php';
                        if (searchType == "buyleads") {
                            window.location.href = '2.php?searchType=' + searchType + '&query=' + encodeURIComponent(query);
                        } else {
                            window.location.href = '3.php?searchType=' + searchType + '&query=' + encodeURIComponent(query);

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', status, error);
                    }
                });
            });
        });
    </script>


</body>

</html>