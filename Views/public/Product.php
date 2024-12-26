<?php
require_once('../../Controllers/CategoryProductController.php');
$productController = new CategoryProductController();
$product = $productController->getProductById($_GET['id']);
$att = $productController->getAttributesByID($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="../Assets/css/Product.css">
</head>
<body>
<?php include('../includes/header.php'); ?>

<div class="container">
    <div class="product-container">
        <div class="product-grid">
            <div class="image-gallery">
                <div class="main-image">
                    <img src="../Assets/images/Product1.png?height=400&width=400" alt="Premium Winter Jacket - Main View" id="mainImage">
                </div>
                <div class="thumbnail-grid">
                    <div class="thumbnail active">
                        <img src="../Assets/images/Product1.png?height=400&width=400" alt="Product View 1" onclick="changeImage(this.src)">
                    </div>
                    <div class="thumbnail">
                        <img src="../Assets/images/Product1.png?height=400&width=400" alt="Product View 2" onclick="changeImage(this.src)">
                    </div>
                    <div class="thumbnail">
                        <img src="../Assets/images/profilePic.png?height=400&width=400" alt="Product View 3" onclick="changeImage(this.src)">
                    </div>
                </div>
            </div>

            <div class="product-info">
                <span class="category-badge"> <?php echo htmlspecialchars($product['type']); ?>  Collection</span>
                <h1 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h1>
                <span class="product-price"><?php echo htmlspecialchars($product['price']); ?></span>
                <p class="product-description"><?php echo htmlspecialchars($att['attribute_value']); ?></p>

                <div>
                    <h3 class="section-title">Available Colors</h3>
                    <div class="color-options">
                        <div class="color-option active" style="background-color: #000000;" title="Black"></div>
                </div>

                <div>
                    <h3 class="section-title">Select Size</h3>
                    <div class="size-options">
                        <div class="size-option">S</div>
                        <div class="size-option active">M</div>
                        <div class="size-option">L</div>
                    </div>
                </div>

                <div class="availability">
                    <i class="fas fa-check-circle"></i>
                    In Stock
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<?php include('../includes/Footer.php'); ?>

<script>
// Image Gallery
function changeImage(src) {
    document.getElementById('mainImage').src = src;
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('active');
        if (thumb.querySelector('img').src === src) {
            thumb.classList.add('active');
        }
    });
}



// Size Selection
document.querySelectorAll('.size-option').forEach(size => {
    size.addEventListener('click', () => {
        document.querySelectorAll('.size-option').forEach(s => s.classList.remove('active'));
        size.classList.add('active');
    });
});
</script>



</body>
</html>
