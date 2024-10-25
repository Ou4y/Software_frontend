<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="adminstyle.css">
  <link rel="stylesheet" href="../Assets/css/adminstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../Assets/css/addedit.css">
  <link rel="stylesheet" href="../Assets/css/navbar.css">
  <title>Edit User</title>
</head>
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
          <h1>Edit user</h1>
        </div>
      </div>
      <main>
        <form id="editUserForm" action="/users/<%= user._id %>?_method=PUT" method="POST" enctype="multipart/form-data">
          <label for="name">New username:</label>
          <input type="text" id="name" name="name" placeholder="Enter new username" required>
      
          <label for="email">New e-mail:</label>
          <input type="email" id="email" name="email" placeholder="Enter new e-mail" required>
      
          <label for="dob">New date of birth:</label>
          <div class="dob-container">
              <select id="dob-day" name="dob-day" class="dob-select" required>
                  <option value="" disabled selected>Day</option>
                  <script>
                      for (let day = 1; day <= 31; day++) {
                          document.write(`<option value="${day}">${day}</option>`);
                      }
                  </script>
              </select>
      
              <select id="dob-month" name="dob-month" class="dob-select" required>
                  <option value="" disabled selected>Month</option>
                  <script>
                      for (let month = 1; month <= 12; month++) {
                          document.write(`<option value="${month}">${month}</option>`);
                      }
                  </script>
              </select>
      
              <select id="dob-year" name="dob-year" class="dob-select" required>
                  <option value="" disabled selected>Year</option>
                  <script>
                      const currentYear = new Date().getFullYear();
                      for (let year = 1920; year <= currentYear; year++) {
                          document.write(`<option value="${year}">${year}</option>`);
                      }
                  </script>
              </select>
          </div>
      
          <div>
              <label for="password">New password</label>
              <input type="password" id="password" name="password" placeholder="Enter new password">
              <label for="password">Confirm password</label>
              <input type="password" id="password" name="password" placeholder="Confirm new password">
          </div>
      
          <button type="submit">Update User</button>
      </form>
      
      </main>
    </main>
  </section>
  <script src="../Assets/js/admin.js"></script>
</body>
</html>
