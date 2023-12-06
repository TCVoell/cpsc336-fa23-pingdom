<?php
// Connect to the database
$db = mysqli_connect('localhost', 'admin', 'password', 'cpsc336');

// Check connection
if (!$db) {
  die('Connection failed: ' . mysqli_connect_error());
}

// Get all products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($db, $sql);

// Check if query was executed successfully
if ($result) {
  $products = [];
  while ($product = mysqli_fetch_assoc($result)) {
    $products[] = $product;
  }

  echo json_encode(['products' => $products]);
} else {
  echo json_encode(['products' => []]);
}

mysqli_close($db);

