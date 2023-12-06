<?php

// Connect to the MySQL database
$db = new mysqli('pingdom.ctp9bh6yvmdl.us-east-1.rds.amazonaws.com', 'admin', 'password', 'cpsc336');

// Check connection
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Get all products from the Inventory table
$sql = "SELECT * FROM Inventory";
$result = $db->query($sql);

// Check if any products were found
if ($result->num_rows > 0) {
    // Fetch all products as an array
    $products = $result->fetch_all(MYSQLI_ASSOC);

    // Display all products
    echo '<html>';
    echo '<head>';
    echo '<title>List Products</title>';
    echo '<style>';
    echo 'body { font-family: Arial, sans-serif; }';
    echo 'table { border-collapse: collapse; width: 80%; margin: 20px auto; }';
    echo 'th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }';
    echo 'th { background-color: #f2f2f2; }';
    echo 'button { display: block; margin: 20px auto; }';
    echo '</style>';
    echo '</head>';
    echo '<body>';
    echo '<h1>List Products</h1>';
    echo '<table>';
    echo '<tr><th>Barcode</th><th>Name</th><th>Quantity</th></tr>';
    foreach ($products as $product) {
        echo '<tr>';
        echo '<td>' . $product['barcode'] . '</td>';
        echo '<td>' . $product['name'] . '</td>';
        echo '<td>' . $product['quantity'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<button onclick="location.href=\'menu.html\'">Back to Menu</button>';
    echo '</body>';
    echo '</html>';
} else {
    echo 'No products found.';
}

// Close the database connection
$db->close();

?>

