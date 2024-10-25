<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="adminstyle.css">
  <link rel="stylesheet" href="../Assets/css/adminstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Assets/css/addedit.css">
  <link rel="stylesheet" href="../Assets/css/navbar.css">
  <title>Edit Product</title>
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
      <h1>Edit Product</h1>
    </div>
  </div>
  
  <form id="addProductForm" enctype="multipart/form-data">
    <label for="title">New Product Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter product title" required>

    <label for="description">New Description:</label>
    <textarea id="description" name="description" placeholder="Enter product description" required></textarea>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" placeholder="Enter product color" required>

    <label for="sizes">Sizes:</label>
    <input type="text" id="sizes" name="sizes" placeholder="Enter available sizes (e.g., S, M, L)" required>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" placeholder="Enter product price" required>

    <label for="category">Category:</label>
    <select id="category" name="category" required>
      <option value="" disabled selected>Select category</option>
      <option value="T-shirts">T-shirts</option>
      <option value="Jeans">Jeans</option>
      <option value="Dresses">Dresses</option>
      <option value="Accessories">Accessories</option>
    </select>
    <button type="submit">Update Product</button>
  </form>
</main>

<script src="../Assets/js/admin.js"></script>
</body>
</html>
