<?php
// Connect to the database
$db = mysqli_connect('localhost', 'admin', 'password', 'cpsc336');

// Check connection
if (!$db) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Get product barcode from POST request
$barcode = $_POST['barcode'];

// Delete product from the database
$sql = "DELETE FROM products WHERE barcode = '$barcode'";
$result = mysqli_query($db, $sql);

// Check if product was deleted successfully
if ($result) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}

mysqli_close($db);

