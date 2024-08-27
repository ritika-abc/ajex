<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the service array exists
    if (isset($_POST['service'])) {
        $services = $_POST['service'];
        
        echo "Selected services and quantities:<br>";
        foreach ($services as $item => $data) {
            // Check if the checkbox was checked
            if (isset($data['checked']) && $data['checked'] == '1') {
                $quantity = isset($data['quantity']) ? htmlspecialchars($data['quantity']) : 'Not specified';
                echo ucfirst($item) . ": Quantity = " . $quantity . "<br>";
            }
        }
    } else {
        echo "No services were selected.";
    }
} else {
    echo "Invalid request.";
}
?>
