<?php
// Connect to the database
$db = mysqli_connect('localhost', 'admin', 'password', 'cpsc336');

// Check connection
if (!$db) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Get product data from POST request
$barcode = $_POST['barcode'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];

// Insert product data into the database
$sql = "INSERT INTO products (barcode, name, quantity) VALUES ('$barcode', '$name', $quantity)";
$result = mysqli_query($db, $sql);

// Check if product was added successfully
if ($result) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}

mysqli_close($db);

