<?php
// Connect to the MySQL database
$db = new mysqli('pingdom.ctp9bh6yvmdl.us-east-1.rds.amazonaws.com', 'admin', 'password', 'cpsc336');

// Check connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Get and sanitize barcode from form data
$barcode = mysqli_real_escape_string($db, $_POST['barcode']);

// Use prepared statement to delete data
$stmt = $db->prepare("DELETE FROM Inventory WHERE barcode = ?");
$stmt->bind_param("s", $barcode);

// Execute the statement
if ($stmt->execute()) {
    echo 'Product deleted successfully.';
} else {
    echo 'Error deleting product: ' . $stmt->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$db->close();

// Redirect to index.html
header('Location: menu.html');
exit();
?>

