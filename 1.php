<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form  action=" " class="mobile-search hidedesktop" id="liveSearchForm">
        <label for="searchType" class="sr-only">Search Type</label>
        <select id="searchType" style="height: 40px;" class="form-control bg-light border text-dark" required>
        <option value="product">Products</option>
        <option value="buyleads">Buyleads</option>
           
        </select>
        <input type="search" style="height: 40px;" class="form-control bg-white border text-dark" name="query" id="searchQuery" placeholder="Search..." required>
        <button style="height: 40px;" class="btn btn-primary border" type="submit"><i class="icon-search"></i> Search</button>
    </form>

 

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        window.location.href = '2.php?searchType=' + searchType + '&query=' + encodeURIComponent(query);
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