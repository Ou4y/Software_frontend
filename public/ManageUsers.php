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
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Phone Number</th>
                    <th>Date of birth</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody id="orderList">
                    <tr>
                      <td>John Doe</td>
                      <td>johndoe@example.com</td>
                      <td>123-456-7890</td>
                      <td>1987-04-12</td>
                      <td>
                        <button class="edit-btn" onclick="window.location.href='editUser.php'">
                          <i class='bx bxs-pencil'></i> Edit
                        </button>
                        <button class="delete-btn">
                          <i class='bx bxs-trash'></i> Delete
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Jane Smith</td>
                      <td>janesmith@example.com</td>
                      <td>987-654-3210</td>
                      <td>1995-08-22</td>
                      <td>
                        <button class="edit-btn" onclick="window.location.href='editUser.php'">
                          <i class='bx bxs-pencil'></i> Edit
                        </button>
                        <button class="delete-btn">
                          <i class='bx bxs-trash'></i> Delete
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Alice John</td>
                      <td>alicejohn@example.com</td>
                      <td>555-1212</td>
                      <td>2001-11-30</td>
                      <td>
                        <button class="edit-btn" onclick="window.location.href='editUser.php'">
                          <i class='bx bxs-pencil'></i> Edit
                        </button>
                        <button class="delete-btn">
                          <i class='bx bxs-trash'></i> Delete
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Bob Brown</td>
                      <td>bobbrown@example.com</td>
                      <td>444-5555</td>
                      <td>1990-02-05</td>
                      <td>
                        <button class="edit-btn" onclick="window.location.href='editUser.php'">
                          <i class='bx bxs-pencil'></i> Edit
                        </button>
                        <button class="delete-btn">
                          <i class='bx bxs-trash'></i> Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>                  
              </table>
            </div>
          </div>
        </div>
      </main>
  </section>
  <script src="../Assets/js/admin.js"></script>
</body>
</html>
