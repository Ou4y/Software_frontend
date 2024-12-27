<?php
require_once('../../Controllers/CategoryProductController.php');
$productController = new CategoryProductController();

// Fetch product details safely
$product = isset($_GET['id']) ? $productController->getProductById($_GET['id']) : null;
if (!$product) {
    die('Product not found.');
}



$productAttributes = isset($_GET['id']) ? $productController->getAttributesByID($_GET['id']) : [];
$attributes = [];
foreach ($productAttributes as $attribute) {
    $attributes[$attribute['attribute_name']] = $attribute['attribute_value'];
}

// Safely access attributes
$description = $attributes['description'] ?? 'No description available.';
$color = $attributes['color'] ?? '#000'; // Default color to black if not specified
$imj1 = $attributes['image1'] ?? 'No image available.';
$imj2 = $attributes['image2'] ?? 'No image available.';
$imj3 = $attributes['image3'] ?? 'No image available.';
$size_s = $attributes['size_s'] ?? '0';
$size_m = $attributes['size_m'] ?? '0';
$size_l = $attributes['size_l'] ?? '0';
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Fashion Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --pd-primary: #1a1a1a;
            --pd-secondary: #333;
            --pd-accent: #ff4444;
            --pd-background: #ffffff;
            --pd-text: #333333;
            --pd-muted: #666666;
            --pd-border: #e5e5e5;
            --pd-shadow: rgba(0, 0, 0, 0.1);
        }

        .pd-wrapper * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .pd-wrapper {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.5;
            color: var(--pd-text);
            background-color: #f8f9fa;
        }

        .pd-outer-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .pd-inner-container {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 4px var(--pd-shadow);
        }

        .pd-layout-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        /* Image Gallery Styles */
        .pd-gallery {
            display: grid;
            gap: 1rem;
        }

        .pd-main-img-wrapper {
            position: relative;
            aspect-ratio: 1;
            overflow: hidden;
            border-radius: 8px;
        }

        .pd-main-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .pd-thumb-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .pd-thumb {
            aspect-ratio: 1;
            cursor: pointer;
            border-radius: 4px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: border-color 0.3s;
        }

        .pd-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pd-thumb.pd-active {
            border-color: var(--pd-primary);
        }

        /* Product Info Styles */
        .pd-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .pd-category {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--pd-primary);
            color: white;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .pd-name {
            font-size: 2rem;
            font-weight: 600;
            line-height: 1.2;
        }

        .pd-cost {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--pd-primary);
        }

        .pd-desc {
            color: var(--pd-muted);
            font-size: 1rem;
            line-height: 1.6;
        }

        /* Color Selection */
        .pd-color-list {
            display: flex;
            gap: 1rem;
        }

        .pd-color-item {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid var(--pd-border);
            transition: transform 0.3s;
        }

        .pd-color-item:hover {
            transform: scale(1.1);
        }

        .pd-color-item.pd-active {
            border-color: var(--pd-primary);
        }

        /* Size Selection */
        .pd-size-list {
            display: flex;
            gap: 0.5rem;
        }

        .pd-size-item {
            min-width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--pd-border);
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .pd-size-item:hover {
            border-color: var(--pd-primary);
        }

        .pd-size-item.pd-active {
            background: var(--pd-primary);
            color: white;
            border-color: var(--pd-primary);
        }

        .pd-section-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .pd-stock-status {
            color: #22c55e;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pd-stock-status i {
            font-size: 1.25rem;
        }

        /* Cart Section */
        .pd-cart-section {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .pd-quantity-control {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .pd-quantity-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pd-qty-btn {
            width: 36px;
            height: 36px;
            border: 2px solid var(--pd-border);
            background: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .pd-qty-btn:hover {
            border-color: var(--pd-primary);
            color: var(--pd-primary);
        }

        .pd-qty-input {
            width: 60px;
            height: 36px;
            border: 2px solid var(--pd-border);
            border-radius: 4px;
            text-align: center;
            font-size: 1rem;
        }

        .pd-qty-input:focus {
            outline: none;
            border-color: var(--pd-primary);
        }

        /* Add to Cart Button */
        .pd-add-cart-btn {
            position: relative;
            width: 100%;
            padding: 1rem;
            background: var(--pd-primary);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .pd-add-cart-btn:hover {
            transform: translateY(-2px);
        }

        .pd-add-cart-btn:active {
            transform: translateY(0);
        }

        .pd-btn-text {
            display: inline-block;
            transition: transform 0.3s, opacity 0.3s;
        }

        .pd-cart-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.7;
        }

        .pd-success-icon {
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            transform: translateY(-50%) scale(0);
            opacity: 0;
            color: white;
            transition: all 0.3s;
        }

        /* Button Animation Classes */
        .pd-add-cart-btn.pd-adding {
            background: var(--pd-primary);
        }

        .pd-add-cart-btn.pd-adding .pd-btn-text {
            transform: translateX(-100%);
            opacity: 0;
        }

        .pd-add-cart-btn.pd-added {
            background: #22c55e;
        }

        .pd-add-cart-btn.pd-added .pd-btn-text,
        .pd-add-cart-btn.pd-added .pd-cart-icon {
            opacity: 0;
        }

        .pd-add-cart-btn.pd-added .pd-success-icon {
            transform: translateY(-50%) scale(1);
            opacity: 1;
        }

        /* Notification Popup */
        .pd-notification {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px var(--pd-shadow);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transform: translateX(120%);
            transition: transform 0.3s;
            z-index: 1000;
        }

        .pd-notification.pd-show {
            transform: translateX(0);
        }

        .pd-notification i {
            color: #22c55e;
        }

        @media (max-width: 768px) {
            .pd-layout-grid {
                grid-template-columns: 1fr;
            }

            .pd-thumb-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .pd-name {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>





<?php include('../includes/header.php'); ?>
<div class="pd-wrapper">
    <div class="pd-outer-container">
        <div class="pd-inner-container">
            <div class="pd-layout-grid">
                <div class="pd-gallery">
                    <div class="pd-main-img-wrapper">
                        <img id="pdMainImage" src="../../Assets/uploads/<?= htmlspecialchars($imj1); ?>" alt="Product Image"  style="width: 100%; height: auto; object-fit: contain; display: block;">
                    </div>
                    <div class="pd-thumb-grid">
                            <div class="pd-thumb pd-active">
                            <img src="../../Assets/uploads/<?= htmlspecialchars($imj1); ?>"  alt="Product Image" onclick="pdChangeImage(this.src)">
                            </div>
                            <div class="pd-thumb">
                            <img src="../../Assets/uploads/<?= htmlspecialchars($imj2); ?>" alt="Product Image" onclick="pdChangeImage(this.src)">
                            </div>
                            <div class="pd-thumb">
                            <img src="../../Assets/uploads/<?= htmlspecialchars($imj3); ?>" alt="Product Image" onclick="pdChangeImage(this.src)">
                            </div>
                        </div>
                        
                </div>

                <div class="pd-info">
                    <span class="pd-category"> <?= htmlspecialchars($product['type']); ?> Collection</span>
                    <h1 class="pd-name"> <?= htmlspecialchars($product['title']); ?></h1>
                    <span class="pd-cost"> $<?= htmlspecialchars($product['price']); ?></span>
                    <p class="pd-desc"> <?= htmlspecialchars($description); ?></p>

                    <div>
                        <h3 class="pd-section-title">Available Colors</h3>
                        <div class="pd-color-list">
                            <div class="pd-color-item pd-active" style="background-color:<?= htmlspecialchars($color); ?>;" title="<?= htmlspecialchars($color); ?>"></div>
                        </div>
                    </div>
                    <div>
                    <h3 class="pd-section-title">Select Size</h3>
<div class="pd-size-list">
    <?php foreach (['S', 'M', 'L'] as $size): ?>
        <div class="pd-size-item" 
             data-size="<?= $size; ?>" 
             data-stock="<?= ${'size_' . strtolower($size)}; ?>">
            <?= $size; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="pd-cart-section">
    <div class="pd-quantity-control">
        <h3 class="pd-section-title">Quantity</h3>
        <div class="pd-quantity-wrapper">
            <button class="pd-qty-btn" onclick="pdUpdateQuantity(-1)">-</button>
            <input type="number" id="pdQuantity" value="1" min="1" class="pd-qty-input">
            <button class="pd-qty-btn" onclick="pdUpdateQuantity(1)">+</button>
        </div>
    </div>

    <button class="pd-add-cart-btn" onclick="pdAddToCart()" disabled>
        <span class="pd-btn-text">Add to Cart</span>
        <div class="pd-cart-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="pd-success-icon">
            <i class="fas fa-check"></i>
        </div>
    </button>
</div>
</div>

<div class="pd-stock-status" id="stockStatus"></div>

<script>
    function pdChangeImage(src) {
        document.getElementById('pdMainImage').src = src;
        document.querySelectorAll('.pd-thumb').forEach(thumb => {
            thumb.classList.remove('pd-active');
            if (thumb.querySelector('img').src === src) {
                thumb.classList.add('pd-active');
            }
        });
    }

    document.querySelectorAll('.pd-color-item').forEach(color => {
        color.addEventListener('click', () => {
            document.querySelectorAll('.pd-color-item').forEach(c => c.classList.remove('pd-active'));
            color.classList.add('pd-active');
        });
    });

    document.querySelectorAll('.pd-size-item').forEach(size => {
    size.addEventListener('click', () => {
        document.querySelectorAll('.pd-size-item').forEach(s => s.classList.remove('pd-active'));
        size.classList.add('pd-active');

        const stock = parseInt(size.dataset.stock);
        const stockStatus = document.getElementById('stockStatus');
        const addToCartBtn = document.querySelector('.pd-add-cart-btn');

        if (stock > 0) {
            stockStatus.innerHTML = `<i class="fas fa-check-circle"></i> ${stock} Available In Stock`;
            stockStatus.style.color = '#22c55e'; // Green color for in stock
                addToCartBtn.disabled = false; // Enable button if in stock
            } else {
                stockStatus.innerHTML = '<i class="fas fa-times-circle"></i> Out of Stock';
                stockStatus.style.color = 'red'; // Red color for out of stock
                addToCartBtn.disabled = true; // Disable button if out of stock
            }
        });
        }
    );


    function pdUpdateQuantity(change) {
        const input = document.getElementById('pdQuantity');
        const currentValue = parseInt(input.value);
        const newValue = currentValue + change;
        
        if (newValue >= 1) {
            input.value = newValue;
        }
    }

    function pdAddToCart() {
        const btn = document.querySelector('.pd-add-cart-btn');
        const popup = document.getElementById('pdNotification');
        const quantity = document.getElementById('pdQuantity').value;
        const selectedSize = document.querySelector('.pd-size-item.pd-active').textContent;
        const selectedColor = document.querySelector('.pd-color-item.pd-active').getAttribute('title');
        
        btn.classList.add('pd-adding');
        
        setTimeout(() => {
            btn.classList.remove('pd-adding');
            btn.classList.add('pd-added');
            
            popup.classList.add('pd-show');
            
            setTimeout(() => {
                btn.classList.remove('pd-added');
                popup.classList.remove('pd-show');
            }, 2000);
        }, 500);
        
        console.log(`Added to cart: ${quantity} items, Size: ${selectedSize}, Color: ${selectedColor}`);
    }

    document.getElementById('pdQuantity').addEventListener('change', function() {
        if (this.value < 1) this.value = 1;
    });
</script>
