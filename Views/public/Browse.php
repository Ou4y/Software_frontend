<?php
require_once('../../Controllers/CategoryProductController.php');

// Example of getting random products in a view
$productController = new CategoryProductController();
$products = $productController->getRandomProducts(3); // Corrected object usage

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse</title>
    <link rel="stylesheet" type="text/css" href="../Assets/css/Browse.css">
</head>
<style>
:root {
  --primary: #1a1a1a;
  --secondary: #333;
  --accent: #ff4444;
  --background: #ffffff;
  --text: #333333;
  --muted: #666666;
  --border: #e5e5e5;
  --shadow: rgba(0, 0, 0, 0.1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  line-height: 1.5;
  color: var(--text);
}

/* Products Section */
.products-section {
  padding: 4rem 0;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.section-title {
  font-size: 2rem;
  font-weight: 700;
}

.view-all {
  color: var(--accent);
  text-decoration: none;
  font-weight: 500;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
}

.product-card {
  background: white;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.3s;
  box-shadow: 0 2px 4px var(--shadow);
}

.product-card:hover {
  transform: translateY(-4px);
}

.product-image {
  position: relative;
  aspect-ratio: 1;
  overflow: hidden;
}

.product-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s;
}

.product-card:hover .product-image img {
  transform: scale(1.05);
}

.product-details {
  padding: 1rem;
}

.product-title {
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.product-price {
  font-weight: 700;
  color: var(--primary);
}

.original-price {
  color: var(--muted);
  text-decoration: line-through;
  margin-left: 0.5rem;
}

/* Features Section */
.features {
  background: #f8f9fa;
  padding: 4rem 0;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.feature-card {
  text-align: center;
  padding: 2rem;
}

.feature-icon {
  font-size: 2.5rem;
  color: var(--accent);
  margin-bottom: 1rem;
}

.feature-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

/* Add to your existing CSS */
.product-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0,0,0,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s;
}

.product-card:hover .product-overlay {
  opacity: 1;
}

.btn-view {
  background: white;
  color: var(--primary);
  padding: 0.75rem 1.5rem;
  border-radius: 4px;
  text-decoration: none;
  font-weight: 600;
  transform: translateY(20px);
  transition: all 0.3s;
}

.product-card:hover .btn-view {
  transform: translateY(0);
}

/* Product Detail Page Styles */
.product-detail {
  padding: 2rem 0;
}

.product-detail-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}

.product-gallery {
  position: relative;
}

.product-gallery img {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.product-info {
  padding: 1rem 0;
}

.product-info h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.product-description {
  color: var(--muted);
  margin: 1rem 0;
}

.product-meta {
  margin: 2rem 0;
}

.size-options {
  display: flex;
  gap: 1rem;
  margin: 1rem 0;
}

.size-option {
  width: 40px;
  height: 40px;
  border: 2px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.3s;
}

.size-option:hover {
  border-color: var(--primary);
}

.size-option.active {
  background: var(--primary);
  color: white;
  border-color: var(--primary);
}

.action-buttons {
  display: flex;
  gap: 1rem;
  margin-top: 2rem;
}

.btn-cart {
  background: var(--primary);
  color: white;
}

.btn-buy {
  background: var(--accent);
  color: white;
}

.quantity-selector {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin: 1rem 0;
}

.quantity-btn {
  width: 30px;
  height: 30px;
  border: 1px solid var(--border);
  background: none;
  cursor: pointer;
  border-radius: 4px;
}

.quantity-input {
  width: 50px;
  text-align: center;
  border: 1px solid var(--border);
  border-radius: 4px;
  padding: 0.5rem;
}


/* Animations */
@keyframes fadeIn {
  from {
      opacity: 0;
      transform: translateY(20px);
  }
  to {
      opacity: 1;
      transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fadeIn 1s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
  .nav-toggle {
      display: block;
  }

  .nav-menu {
      display: none;
      position: absolute;
      top: 70px;
      left: 0;
      right: 0;
      background: var(--background);
      padding: 1rem;
      flex-direction: column;
      gap: 1rem;
      border-bottom: 1px solid var(--border);
  }

  .nav-menu.active {
      display: flex;
  }

  .hero-title {
      font-size: 2.5rem;
  }

  .products-grid {
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  }
}

</style>
<body>

<?php include('../includes/header.php'); ?>



<div class="image-links">
    <a href="../public/products.php?type=MEN" class="unique-hover-card"><h1>Men</h1></a>
    <a href="../public/products.php?type=WOMEN" class="unique-hover-card"><h1>Women</h1></a>
    <a href="../public/products.php?type=SPORTWEAR" class="unique-hover-card"><h1>Sports Wear</h1></a>
    <a href="../public/products.php?type=UNISEX" class="unique-hover-card"><h1>Unisex</h1></a>
</div>

<hr>

<h1 id="title">Random Products:</h1>

<section class="products-section container">
    <div class="products-grid">
        <?php if (!empty($products)): ?>
          <?php foreach ($products as $product): ?>
              <article class="product-card">
                  <div class="product-image">
                      <img src="../../Assets/uploads/<?= htmlspecialchars($productController->getImageByID($product['id'])['attribute_value']) ?>" onerror="this.src='../Assets/default_image.jpg';" alt="Product Image">
                      <div class="product-overlay">
                          <a href="Product.php?id=<?php echo $product['id']; ?>" class="btn btn-view">View Product</a>
                      </div>
                  </div>
                  <div class="product-details">
                      <h3 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h3>
                      <p class="product-price">
                          $<?php echo htmlspecialchars($product['price']); ?>
                          <?php if (!empty($product['discount'])): ?>
                              <span class="original-price">$<?php echo htmlspecialchars($product['price'] + $product['discount']); ?></span>
                          <?php endif; ?>
                      </p>
                  </div>
              </article>
          <?php endforeach; ?>
      <?php else: ?>
          <p>No products available at the moment.</p>
      <?php endif; ?>
    </div>
</section>

<?php include('../includes/Footer.php'); ?>
</body>
</html>