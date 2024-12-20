<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/adminstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Assets/css/navbar.css">
    <title>Admin Panel</title>
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
          <h1>Dashboard</h1>
          <ul class="breadcrumb">
            
          </ul>
        </div>
      </div>
      <ul class="box-info">
        <li>
          <i class='bx bx-user' style='color:#ffffff'></i>
          <span class="text">
            <h3>150</h3>
            <p>Users</p>
          </span>
        </li>
        <li>
          <i class='bx bx-shopping-bag'></i>
          <span class="text">
            <h3>10000</h3>
            <p>Products</p>
          </span>
        </li>
        <li>
          <i class='bx bx-dollar' ></i>
          <span class="text">
            <h3>200000</h3>
            <p>Total profit</p>
          </span>
        </li>
      </ul>
      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Ongoing Orders </h3>
            <box-icon name='search'></box-icon>
            
          </div>
          <table>
            <thead>
              <tr>
                <th>Username</th>
                <th>E-mail</th>
                <th>Phone Number</th>
                <th>Delivery date</th>
              </tr>
            </thead>
            <tbody id="orderList">
              <tr>
                <td>John Doe</td>
                <td>johndoe@example.com</td>
                <td>123-456-7890</td>
                <td>2023-12-25</td>
              </tr>
              <tr>
                <td>Jane Smith</td>
                <td>janesmith@example.com</td>
                <td>987-654-3210</td>
                <td>2024-01-10</td>
              </tr>
              <tr>
                <td>Alice Johnson</td>
                <td>alicejohnson@example.com</td>
                <td>555-1212</td>
                <td>2024-02-15</td>
              </tr>
              <tr>
                <td>Bob Brown</td>
                <td>bobbrown@example.com</td>
                <td>444-5555</td>
                <td>2024-03-20</td>
              </tr>
            </tbody>
          </table>
        </div>
        
      </div>
    </main>
  </section>
  <script src="../Assets/js/admin.js"></script>
</body>
</html>
