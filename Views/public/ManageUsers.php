<?php 
include_once '../includes/db_connection.php';

$sql = "SELECT ID,Username, Email, Phone FROM customer"; 
$result = mysqli_query($conn, $sql);
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
  <style>
    #orderList tr {
      color: white; 
    }

    table thead th {
      color: white; 
      background-color: #444; 
    }


    table tbody tr:hover {
      background-color: #555;
    }


  </style>
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
          <h1>Manage Users</h1>
          <div class="table-data">
            <div class="order">
              <div class="head">
                <h3>Users</h3>
                <button class="add-btn" onclick="window.location.href='adduser.php'">
                    <i class='bx bxs-plus-circle'></i> Add User
                </button>
                <box-icon name='search'></box-icon>
              </div>
              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Phone Number</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody id="orderList">
                  <?php
                  
                  if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                      echo "<td>" . htmlspecialchars($row['Phone']) . "</td>";
                      echo "<td>
                              <button class='edit-btn' onclick=\"window.location.href='editUser.php?ID=" . htmlspecialchars($row['ID']) . "'\">
                                <i class='bx bxs-pencil'></i> Edit
                              </button>
                              <button class='delete-btn' onclick=\"confirmDelete('" . htmlspecialchars($row['ID']) . "')\">
                                <i class='bx bxs-trash'></i> Delete
                              </button>
                            </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                  }
                  ?>
                </tbody>                  
              </table>
            </div>
          </div>
        </div>
      </main>
  </section>
  <script src="../Assets/js/admin.js"></script>
  <script>
    function confirmDelete(userId) {
      if (confirm("Are you sure you want to delete this user?")) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteUser.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              const row = document.querySelector(`tr[data-id='${userId}']`);
              if (row) {
                row.remove();
              }
            } else {
              alert("Error deleting user. Please try again.");
            }
          }
        };
        xhr.send("ID=" + encodeURIComponent(userId));
      }
      location.reload();
    }
  </script>
</body>
</html>
