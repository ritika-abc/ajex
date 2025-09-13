<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Price Filter -->
    <label>Price Range:</label>
    <input type="range" id="priceRange" min="0" max="1000" step="50" value="500">
    <span id="priceValue">$500</span>

    <!-- Color Filter -->
    <label>Color:</label><br>
    <input type="checkbox" class="color-filter" value="Red"> Red<br>
    <input type="checkbox" class="color-filter" value="Blue"> Blue<br>
    <input type="checkbox" class="color-filter" value="Green"> Green<br>

    <!-- Availability -->
    <label>Availability:</label><br>
    <input type="radio" name="availability" value="in_stock" checked> In Stock<br>
    <input type="radio" name="availability" value="out_of_stock"> Out of Stock<br>

    <!-- Product Container -->
    <div id="productList"></div>





    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const priceRange = document.getElementById("priceRange");
            const priceValue = document.getElementById("priceValue");

            function fetchProducts() {
                const selectedColors = Array.from(document.querySelectorAll(".color-filter:checked"))
                    .map(el => el.value);

                const availability = document.querySelector('input[name="availability"]:checked').value;
                const price = priceRange.value;

                fetch("filter.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            price: price,
                            colors: selectedColors,
                            availability: availability
                        })
                    })
                    .then(res => res.text())
                    .then(data => {
                        document.getElementById("productList").innerHTML = data;
                    });
            }

            // Bind events
            priceRange.addEventListener("input", () => {
                priceValue.textContent = `$${priceRange.value}`;
                fetchProducts();
            });

            document.querySelectorAll(".color-filter, input[name='availability']").forEach(el => {
                el.addEventListener("change", fetchProducts);
            });

            // Initial fetch
            fetchProducts();
        });
    </script>

</body>

</html>