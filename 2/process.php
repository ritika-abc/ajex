<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any checkboxes were selected
    if (isset($_POST['fruits'])) {
        // Get the array of selected values
        $selectedFruits = $_POST['fruits'];
        
        // Display selected fruits
        echo "You selected the following fruits:<br>";
        foreach ($selectedFruits as $fruit) {
            echo htmlspecialchars($fruit) . "<br>";
        }
    } else {
        echo "No fruits were selected.";
    }
} else {
    echo "Invalid request.";
}
?>
