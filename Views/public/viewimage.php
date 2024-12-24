<?php
require_once('C:/xampp/htdocs/Software_frontend/Controllers/ProductController.php');

// Create an instance of the ProductController
$productController = new ProductController();

// Fetch all products
$products = $productController->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product Images</title>
    <style>
        .product-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }
        .product-image {
            margin: 10px;
            width: 200px;
            height: 200px;
        }
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>Product Images</h1>
    
    <?php if ($products): ?>
        <div class="product-images">
            <?php foreach ($products as $product): ?>
                <!-- Check and display each picture if it exists -->
                <?php if ($product['picture1']): ?>
                    <div class="product-image">
                        <!-- Use the correct path to the images stored in the 'Assets/uploads' folder -->
                        <img src="/Software_frontend/Assets/uploads/<?= htmlspecialchars($product['picture1']) ?>" alt="Product Image 1">
                    </div>
                <?php endif; ?>

                <?php if ($product['picture2']): ?>
                    <div class="product-image">
                        <img src="/Software_frontend/Assets/uploads/<?= htmlspecialchars($product['picture2']) ?>" alt="Product Image 2">
                    </div>
                <?php endif; ?>

                <?php if ($product['picture3']): ?>
                    <div class="product-image">
                        <img src="/Software_frontend/Assets/uploads/<?= htmlspecialchars($product['picture3']) ?>" alt="Product Image 3">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No product images found.</p>
    <?php endif; ?>
</body>
</html>
