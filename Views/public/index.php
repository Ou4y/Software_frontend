<?php
require_once('../../Controllers/CategoryProductController.php');

// Example of getting men's products in a view
$productController = new CategoryProductController();
$latest = $productController->getLatestProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="../Assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include('../includes/header.php'); ?>

<main>
    <section class="hero">
        <video autoplay muted loop id="back1">
            <source src="../Assets/images/videoplayback.mp4" type="video/mp4">
        </video>
        <div class="hero-content animate-fade-in">
            <h1 class="hero-title">New Winter Collection</h1>
            <p class="hero-subtitle">Discover our latest winter styles, designed for both comfort and elegance</p>
            <a href="#" class="btn btn-primary">Shop Now</a>
        </div>
    </section>

    <section class="products-section container">
    <div class="section-header">
        <h2 class="section-title">Latest Products:</h2>
    </div>
    <div class="products-grid">
        <?php if (!empty($latest)): ?>
            <?php foreach ($latest as $product): ?>
                <article class="product-card">
                    <div class="product-image">

                    <img src="../../Assets/uploads/<?= htmlspecialchars($product['image']) ?>"  onerror="this.src='../Assets/default_image.jpg';" alt="Product Image">
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



    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-truck feature-icon"></i>
                    <h3 class="feature-title">Fast Delivery</h3>
                    <p>Free shipping on orders over $50</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h3 class="feature-title">Secure Payment</h3>
                    <p>100% secure payment</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-undo feature-icon"></i>
                    <h3 class="feature-title">Easy Returns</h3>
                    <p>30-day return policy</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-headset feature-icon"></i>
                    <h3 class="feature-title">24/7 Support</h3>
                    <p>Dedicated support team</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('../includes/Footer.php'); ?>

</body>
</html>
