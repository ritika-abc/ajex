<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Leads</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<!-- Product filter dropdown -->
<select id="product-filter">
    <option value="">Select Product</option>
    <option value="apple">Apple</option>
    <option value="mango">Mango</option>
    <option value="rice">Rice</option>
</select>

<!-- Button to show all buy leads -->
<button id="show-all-leads">Show All Buy Leads</button>

<!-- Div to display the buy leads -->
<div id="buy-leads-list"></div>

<script>
// Function to fetch and display leads based on product filter
function fetchLeads(product) {
    $.ajax({
        url: 'fetch_buy_leads.php',
        type: 'GET',
        data: { product: product },
        success: function(response) {
            $('#buy-leads-list').html(response);
        }
    });
}

// Show all leads when the button is clicked
$('#show-all-leads').click(function() {
    fetchLeads('');  // Empty filter to show all leads
});

// Filter leads based on product selection
$('#product-filter').change(function() {
    var selectedProduct = $(this).val();
    fetchLeads(selectedProduct);  // Fetch leads based on selected product
});

// Load all leads on initial page load
fetchLeads('');
</script>

</body>
</html>
