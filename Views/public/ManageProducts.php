<?php 
require_once('../../Controllers/ProductController.php');
// session_start();

$products = $controller->getAllProducts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="../Assets/css/adminstyle.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../Assets/css/navbar.css">
  <title>Manage Products</title>
</head>
<body>
  <section id="sidebar">
    <a href="#" class="brand">
      <i class='bx bxl-xing'></i>
      <span class="icon">Admin Dashboard</span>
    </a>
    <ul class="side-menu top">
      <li><a href="admin.php"><i class='bx bxs-dashboard' style='color:#ffffff'></i><span class="text">Menu</span></a></li>
      <li><a href="ManageUsers.php"><i class='bx bxs-user-plus' style='color:#ffffff'></i><span class="text">Manage Users</span></a></li>
      <li><a href="createAdmin.php"><i class='bx bxs-group'></i><span class="text">Create Admin</span></a></li>
      <li><a href="ManageProducts.php"><i class='bx bxs-shopping-bags' style='color:#ffffff'></i><span class="text">Manage Products</span></a></li>
    </ul>  
  </section>
  <section id="content">
    <nav>
      <i class='bx bx-menu menu-icon'></i>
      <button class="logout-btn"><i class='bx bx-log-out'></i>Logout</button>
    </nav>

    <main>
      <div class="head-title">
        <div class="left">
          <h1>Manage Products</h1>
          <div class="table-data">
            <div class="order">
              <div class="head">
                <h3>Products</h3>
                <button class="add-btn" onclick="window.location.href='addproduct.php'">
                  <i class='bx bxs-plus-circle'></i> Add Product
                </button>
              </div>
              <table>
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Total Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody id="orderList">
                  <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                      <tr data-id="<?= htmlspecialchars($product['id']) ?>">
                        <td><?= htmlspecialchars($product['title']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td><?= htmlspecialchars($product['available_colors']) ?></td>
                        <td><?= htmlspecialchars($product['Quantity_S'] + $product['Quantity_M'] + $product['Quantity_L']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?></td>
                        <td><?= htmlspecialchars($product['category']) ?></td>
                        <td><?= htmlspecialchars($product['type']) ?></td>
                        <td>
                          <button class="edit-btn" onclick="window.location.href='editProduct.php?id=<?= $product['id'] ?>'">
                            <i class='bx bxs-pencil'></i> Edit
                          </button>
                          <button class="delete-btn" onclick="confirmDelete(<?= $product['id'] ?>)">
                            <i class='bx bxs-trash'></i> Delete
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="7">No products found.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </section>
  <script src="../Assets/js/admin.js"></script>
  <script>
   function confirmDelete(productid) {
  if (!productid) {
    alert("Invalid product ID.");
    return;
  }

  if (confirm("Are you sure you want to delete this product?")) {
    fetch(window.location.href, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `id=${encodeURIComponent(productid)}&deleteProduct=true`  // Add deleteProduct flag
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert("Product deleted successfully.");
        const row = document.querySelector(`tr[data-id='${productid}']`);
        if (row) row.remove();
      } else {
        alert(data.message || "Failed to delete product.");
      }
    })
    .catch(error => {
      alert("An error occurred: " + error.message);
      console.error("Error:", error);
    });
  }
}


  </script>
</body>
</html>
