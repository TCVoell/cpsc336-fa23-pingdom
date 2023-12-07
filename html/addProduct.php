<?php
// Connect to the MySQL database
$db = new mysqli('pingdom.ctp9bh6yvmdl.us-east-1.rds.amazonaws.com', 'admin', 'password', 'cpsc336');

// Check connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Get and sanitize form data
$barcode = mysqli_real_escape_string($db, $_POST['barcode']);
$name = mysqli_real_escape_string($db, $_POST['name']);
$quantity = mysqli_real_escape_string($db, $_POST['quantity']);

// Check if barcode already exists in the database
$checkQuery = "SELECT * FROM Inventory WHERE barcode = '$barcode'";
$result = $db->query($checkQuery);

if ($result->num_rows > 0) {
    echo 'Error adding product: Barcode already exists.';
} else {
    // Use prepared statement to insert data
    $stmt = $db->prepare("INSERT INTO Inventory (barcode, name, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $barcode, $name, $quantity);

    // Execute the statement
    if ($stmt->execute()) {
        echo 'Product added successfully.';

        // Redirect to index.html
        header('Location: menu.html');
        exit();
    } else {
        echo 'Error adding product: ' . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$db->close();
?>
