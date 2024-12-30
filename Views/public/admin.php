<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: LoginSignup.php");
    exit();
}
require_once('../../Controllers/AdminController.php');

$controller = new AdminController();
$data = $controller->getDashboardData(); // Get the dashboard data (total users and total products)
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
      <a  href='logout.php' class="logout-btn"><i class='bx bx-log-out'></i>Logout</a>
    </nav>

    <main>
      <div class="head-title">
        <div class="left">
          <h1>Dashboard</h1>
          <ul class="breadcrumb"></ul>
        </div>
      </div>

      <ul class="box-info">
        <li>
          <i class='bx bx-user' style='color:#ffffff'></i>
          <span class="text">
            <h3><?php echo $data['totalUsers']; ?></h3>
            <p>Users</p>
          </span>
        </li>
        <li>
          <i class='bx bx-shopping-bag'></i>
          <span class="text">
            <h3><?php echo $data['totalProducts']; ?></h3>
            <p>Products</p>
          </span>
        </li>
        <li>
          <i class='bx bx-dollar'></i>
          <span class="text">
            <h3><?php echo $data['totalOrders'];?></h3>
            <p>Total Orders</p>
          </span>
        </li>
      </ul>

      <div class="table-data">
        <div class="order">
          <div class="head">
            <h3>Orders:</h3>
            <box-icon name='search'></box-icon>
          </div>
          <table>
            <thead>
              <tr>
                <th>Username</th>
                <th>E-mail</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody id="orderList">
            <tbody id="orderList">
              
    <?php
    // Display the orders dynamically
    if ($data['orders']) {
        foreach ($data['orders'] as $order) {
            echo "<tr>
                    <td>{$order['username']}</td>
                    <td>{$order['email']}</td>
                    <td>{$order['total_amount']}</td>
                    <td>{$order['order_date']}</td>
                    <td>{$order['status']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No orders found</td></tr>";
    }
    ?>
</tbody>


          </table>
        </div>
      </div>
    </main>
  </section>

  <script src="../Assets/js/admin.js"></script>
</body>
</html>
