<?php 
require_once('../../Controllers/ProductController.php');
$controller = new ProductController();
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
  <link rel="stylesheet" href="../Assets/css/manageProducts.css">
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
      <a href='logout.php' class="logout-btn"><i class='bx bx-log-out'></i>Logout</a>
    </nav>
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Manage Products</h1>
          <div>
            <button class="add-btn" onclick="window.location.href='addproduct.php'">
              <i class='bx bxs-plus-circle'></i> Add Product
            </button>
          </div>
          <div class="products-container">
            <?php if (!empty($products)): ?>
              <?php foreach ($products as $product): ?>
                <div class="product-card">
                  <h4><?= htmlspecialchars($product['title']) ?></h4>
                  <div class="price">$<?= htmlspecialchars($product['price']) ?></div>
                  <div class="attributes">
                    <ul>
                      <?php foreach ($product['attributes'] as $name => $value): ?>
                        <li><strong><?= htmlspecialchars($name) ?>:</strong> <?= htmlspecialchars($value) ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                  <div class="product-images">
                    <?php if (!empty($product['images'])): ?>
                      <?php foreach ($product['images'] as $image): ?>
                        <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($product['title']) ?>" class="product-image">
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                  <div class="options">
                    <button class="edit-btn" onclick="window.location.href='editProduct.php?id=<?= $product['id'] ?>'">
                      <i class='bx bxs-pencil'></i> Edit
                    </button>
                    <button class="delete-btn" onclick="confirmDelete(<?= $product['id'] ?>)">
                      <i class='bx bxs-trash'></i> Delete
                    </button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <p>No products found.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </main>
  </section>
  <script>
    function confirmDelete(productId) {
      if (!productId) {
        alert("Invalid product ID.");
        return;
      }

      if (confirm("Are you sure you want to delete this product?")) {
        fetch(window.location.href, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `id=${encodeURIComponent(productId)}&deleteProduct=true`
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert("Product deleted successfully.");
            location.reload();
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
