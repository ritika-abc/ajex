<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textarea Formatting and Insert with PHP</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .output {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
            white-space: pre-wrap; /* To maintain line breaks */
        }
        .table-container {
            border-collapse: collapse;
            width: 100%;
        }
        .table-container th, .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table-container th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <form id="myForm">
        <label for="myTextarea">Enter text:</label>
        <textarea id="myTextarea" rows="5" cols="40"></textarea><br><br>
        <button type="button" id="boldButton">Bold</button>
        <button type="button" id="tableButton">Table Format</button>
        <button type="button" id="insertButton">Insert Row</button><br><br>
        <label for="insertRow">Insert new row (tab-separated):</label>
        <input type="text" id="insertRow" size="50"/><br><br>
        <div class="output" id="output">Text will appear here...</div>
    </form>

    <script>
        $(document).ready(function() {
            let tableHtml = '';

            $('#boldButton').click(function() {
                const text = $('#myTextarea').val();
                const boldText = '<strong>' + text + '</strong>';
                $('#output').html(boldText);
            });

            $('#tableButton').click(function() {
                const text = $('#myTextarea').val();
                const lines = text.split('\n');
                tableHtml = '<table class="table-container"><thead><tr>';

                // Assuming first line is header
                if (lines.length > 0) {
                    const headers = lines[0].split('\t');
                    headers.forEach(function(header) {
                        tableHtml += '<th>' + header + '</th>';
                    });
                    tableHtml += '</tr></thead><tbody>';
                    
                    // Adding data rows
                    for (let i = 1; i < lines.length; i++) {
                        const cells = lines[i].split('\t');
                        tableHtml += '<tr>';
                        cells.forEach(function(cell) {
                            tableHtml += '<td>' + cell + '</td>';
                        });
                        tableHtml += '</tr>';
                    }

                    tableHtml += '</tbody></table>';
                }

                $('#output').html(tableHtml);
            });

            $('#insertButton').click(function() {
                const newRow = $('#insertRow').val();
                if (tableHtml) {
                    const newRowCells = newRow.split('\t');
                    const newRowHtml = '<tr>';
                    newRowCells.forEach(function(cell) {
                        newRowHtml += '<td>' + cell + '</td>';
                    });
                    newRowHtml += '</tr>';

                    // Append new row to the existing table
                    $('#output table tbody').append(newRowHtml);
                }
                $('#insertRow').val(''); // Clear the input field
            });

            // Handle form submission to PHP
            $('#myForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                
                // Gather textarea and table data
                const textareaData = $('#myTextarea').val();
                const tableData = $('#output').html();
                
                // Send data to PHP script via AJAX
                $.ajax({
                    url: 'process.php',
                    type: 'POST',
                    data: {
                        textareaData: textareaData,
                        tableData: tableData
                    },
                    success: function(response) {
                        alert('Data sent to PHP script successfully.');
                    },
                    error: function() {
                        alert('An error occurred.');
                    }
                });
            });
        });
    </script>
</body>
</html>
