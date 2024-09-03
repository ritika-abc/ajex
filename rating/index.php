<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating System</title>
    <style>
        .star { cursor: pointer; font-size: 24px; color: gray; }
        .star.checked { color: gold; }
    </style>
</head>
<body>
    <div id="rating-container">
        <span class="star" data-rating="1">&#9733;</span>
        <span class="star" data-rating="2">&#9733;</span>
        <span class="star" data-rating="3">&#9733;</span>
        <span class="star" data-rating="4">&#9733;</span>
        <span class="star" data-rating="5">&#9733;</span>
    </div>
    <div id="average-rating">Average Rating: <span id="rating-value">0</span></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var itemId = 1; // Example item ID
            var userId = 1; // Example user ID

            // Load current average rating
            function loadRating() {
                $.get('get_ratings.php', { item_id: itemId }, function(data) {
                    var averageRating = JSON.parse(data).average_rating;
                    $('#rating-value').text(averageRating ? averageRating.toFixed(1) : '0');
                });
            }

            loadRating();

            // Handle star click event
            $('#rating-container').on('click', '.star', function() {
                var rating = $(this).data('rating');

                $.post('rate.php', { item_id: itemId, user_id: userId, rating: rating }, function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        $('.star').removeClass('checked');
                        $('.star').each(function() {
                            if ($(this).data('rating') <= rating) {
                                $(this).addClass('checked');
                            }
                        });
                        loadRating();
                    }
                });
            });
        });
    </script>
</body>
</html>
