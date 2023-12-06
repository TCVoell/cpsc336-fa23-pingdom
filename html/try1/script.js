const addProductForm = document.getElementById('addProductForm'); // Assign the DOM element to the constant
const deleteProductForm = document.getElementById('deleteProductForm');
const productsTable = document.getElementById('productsTable');

addProductForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const barcode = document.getElementById('barcode').value;
  const name = document.getElementById('name').value;
  const quantity = parseInt(document.getElementById('quantity').value);

  // Send data to server for adding product
  fetch('addProduct.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `barcode=${barcode}&name=${name}&quantity=${quantity}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Product added successfully');
      // Refresh the product list
      loadProducts();
    } else {
      alert('Error adding product');
    }
  });
});

deleteProductForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const barcode = document.getElementById('barcode').value;

  // Send data to server for deleting product
  fetch('deleteProduct.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `barcode=${barcode}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Product deleted successfully');
      // Refresh the product list
      loadProducts();
    } else {
      alert('Error deleting product');
    }
  });
});

function loadProducts() {
  fetch('getProducts.php')
  .then(response => response.json())
  .then(data => {
    const products = data.products;
    const productRows = products.map(product => {
      return `<tr>
        <td>${product.barcode}</td>
        <td>${product.name}</td>
        <td>${product.quantity}</td>
      </tr>`;
    });

    productsTable.innerHTML = `<tbody>${productRows.join('')}</tbody>`;
  });
}

loadProducts();

