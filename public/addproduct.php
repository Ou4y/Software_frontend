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
    </div>
  </div>
  
  <form id="addProductForm" enctype="multipart/form-data">
    <label for="title">Product Title:</label>
    <input type="text" id="title" name="title" placeholder="Enter product title" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" placeholder="Enter product description" required></textarea>

    <label for="color">Color:</label>
    <input type="text" id="color" name="color" placeholder="Enter product color" required>

    <label for="sizes">Sizes:</label>
    <input type="text" id="sizes" name="sizes" placeholder="Enter available sizes (e.g., S, M, L)" required>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" placeholder="Enter product price" required>

    <label for="category">Category:</label>
    <div class="custom-multi-select" onclick="toggleDropdown()">
        <span id="selected-categories">Select category</span>
        <div id="dropdown-options" class="dropdown-options">
            <label><input type="checkbox" value="T-shirts" name="category[]"> T-shirts</label>
            <label><input type="checkbox" value="Jeans" name="category[]"> Jeans</label>
            <label><input type="checkbox" value="Dresses" name="category[]"> Dresses</label>
            <label><input type="checkbox" value="Hoodie" name="category[]"> Hoodie</label>
            <label><input type="checkbox" value="Jacket" name="category[]"> Jacket</label>
            <label><input type="checkbox" value="Sportswear" name="category[]"> Sportswear</label>
            <label><input type="checkbox" value="Cargo pants" name="category[]"> Cargo pants</label>
            <label><input type="checkbox" value="Sweatpants" name="category[]"> Sweatpants</label>
        </div>
    </div>

    <label for="photo">Upload Photo:</label>
    <div class="custom-file-upload">
        <input type="file" id="photo" name="photo" accept="image/*" required>
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
