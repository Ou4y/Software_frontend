<?php 
require_once('../../Controllers/ProductController.php');
// session_start();
$controller = new ProductController();
$controller->handleRequest();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'addProductForm') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $color = $_POST['color'];
    $size_s = intval($_POST['size_s']);
    $size_m = intval($_POST['size_m']);
    $size_l = intval($_POST['size_l']);
    $price = floatval($_POST['price']);
    $category = $_POST['category'];
    $gender = $_POST['gender'];
    $discount = intval($_POST['disnumber']);
    $photo = $_FILES['photo'];

    // Call the ProductController to handle product creation
    
    $result = $controller->addProduct($title, $description, $color, $size_s, $size_m, $size_l, $price, $category, $gender, $discount, $photo);

    // Redirect or display a message based on the result
    if ($result) {
        header('Location: ManageProducts.php?success=1'); // Redirect to the products page with a success message
        exit;
    } else {
        $error = "Failed to add product. Please try again.";
    }
}
echo var_dump($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="../Assets/css/adminstyle.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../Assets/css/addedit.css">
  <link rel="stylesheet" href="../Assets/css/navbar.css">
  <title>Add Product</title>
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
      <h1>Add Product</h1>
      <?php if (isset($error)) : ?>
          <p class="error-message"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
  
  <form id="addProductForm" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="form_type" value="addProductForm">
    
    <label for="title">Product Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter product title" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" placeholder="Enter product description" required></textarea>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" placeholder="Enter product color" required>

    <label for="sizes">Available Sizes:</label>
    <div id="sizes">
        <label for="size-s">S:</label>
        <input type="number" id="size-s" name="size_s" placeholder="Enter quantity for S" min="0" required>
        
        <label for="size-m">M:</label>
        <input type="number" id="size-m" name="size_m" placeholder="Enter quantity for M" min="0" required>
        
        <label for="size-l">L:</label>
        <input type="number" id="size-l" name="size_l" placeholder="Enter quantity for L" min="0" required>
    </div>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" placeholder="Enter product price" required>

    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <option value="" disabled selected>Select category</option>
        <option value="Shirts">Shirts</option>
        <option value="Pants">Pants</option>
        <option value="Jackets">Jackets</option>
    </select>

    <label for="gender">Product For:</label>
    <select id="type" name="type" required>
        <option value="" disabled selected>Select Type</option>
        <option value="MEN">MEN</option>
        <option value="WOMEN">WOMEN</option>
        <option value="UNISEX">UNISEX</option>
        <option value="SPORTSWEAR">SPORTSWEAR</option>
    </select>

    <label for="disnumber">Discount:</label>
    <input type="number" id="disnumber" name="disnumber" placeholder="Enter discount percentage" required>

    <label for="photo">Upload Photo:</label>
    <div class="custom-file-upload">
        <input type="file" id="photo" name="photo[]" accept="image/*" multiple required>
        <span id="file-chosen">No file chosen</span>
    </div>

    <div class="button-container">
        <button type="submit">Add Product</button>
    </div>
  </form>

</main>
<script src="../Assets/js/admin.js"></script>
<script src="../Assets/js/choosefile.js"></script>
<script src="../Assets/js/dropdown.js"></script>
</body>
</html>
