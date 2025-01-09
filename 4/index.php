<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Multiple Values</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .item { margin: 5px; padding: 5px; border: 1px solid #ddd; display: inline-block; }
    </style>
</head>
<body>

    <h3>Add Multiple Values</h3>

    <!-- Single input to add values separated by commas -->
    <label for="multiInput">Enter values (separate by commas): </label>
    <input type="text" id="multiInput" placeholder="Value1, Value2, Value3">
    <button id="addValues">Add Values</button>

    <div id="addedValues"></div>

    <script>
        $(document).ready(function () {
            // Click event to handle adding values
            $('#addValues').click(function () {
                const inputVal = $('#multiInput').val().trim(); // Get the value from input field

                // Check if input is not empty
                if (inputVal) {
                    // Split the input by commas and trim extra spaces
                    const values = inputVal.split(',').map(item => item.trim());

                    // Send values to PHP for insertion into the database
                    $.ajax({
                        url: 'process_values.php',  // Path to your PHP script
                        method: 'POST',
                        data: { values: values },
                        success: function (response) {
                            const data = JSON.parse(response);
                            console.log(data.message);  // Show success message in console

                            // Clear the input field and display added values
                            $('#multiInput').val('');
                            displayValues(values);
                        },
                        error: function (xhr, status, error) {
                            console.log('AJAX Error: ' + status + error);
                        }
                    });
                } else {
                    alert("Please enter some values.");
                }
            });

            // Function to display values in the DOM
            function displayValues(values) {
                $('#addedValues').html('');
                values.forEach(function (value) {
                    $('#addedValues').append('<div class="item">' + value + '</div>');
                });
            }
        });
    </script>
</body>
</html>
