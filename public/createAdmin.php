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
  <title>Add Admin</title>
  <style>
.table-container {
	display: flex;
	flex-wrap: wrap;
	grid-gap: 16px;
	margin-top: 16px;
	width: 100%;
	color: var(--text-color2);
}
.table-container > .admin-table {
	border-radius: 12px;
	background: black;
	padding: 16px;
	overflow-x: auto;
}
.table-container .table-header {
	display: flex;
	align-items: center;
	grid-gap: 12px;
	margin-bottom: 16px;
}
.table-container .table-header h3 {
	margin-right: auto;
	font-size: 20px;
	font-weight: 600;
}
.table-container .table-header .bx {
	cursor: pointer;
}

.table-container .admin-table {
	flex-grow: 1;
	flex-basis: 400px;
}
.table-container .admin-table table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
}
.table-container .admin-table table th {
    padding-bottom: 8px;
    font-size: 12px;
    text-align: left;
    border-bottom: 1px solid var(--grey);
}
.table-container .admin-table table td {
    padding: 12px 16px;
}

.table-container .admin-table table tr td:first-child {
	display: flex;
	align-items: center;
	grid-gap: 8px;
	padding-left: 4px;
}
.table-container .admin-table table td img {
	width: 28px;
	height: 28px;
	border-radius: 50%;
	object-fit: cover;
}
.table-container .admin-table table tbody tr:hover {
	background: rgb(50, 49, 49);
}
.table-container .admin-table table tr td .status {
	font-size: 9px;
	padding: 4px 12px;
	color: var(--light);
	border-radius: 16px;
	font-weight: 700;
}
.table-container .admin-table table tr td .status.completed {
	background: var(--blue);
}
.table-container .admin-table table tr td .status.process {
	background: var(--yellow);
}
.table-container .admin-table table tr td .status.pending {
	background: var(--orange);
}

button {
	cursor: pointer;
	border: 1px solid transparent;
	border-radius: 4px;
	padding: 4px 8px;
	font-size: 12px;
	display: inline-flex;
	align-items: center;
	background-color: transparent;
	transition: background-color 0.3s ease, border-color 0.3s ease;
}
button i {
	margin-right: 3px;
}

.add-btn {
	color: #28a745;
	border-color: #28a745;
}
.add-btn:hover {
	background-color: rgba(40, 167, 69, 0.1);
}
.edit-btn {
	color: #007bff;
	border-color: #007bff;
}
.edit-btn:hover {
	background-color: rgba(0, 123, 255, 0.1);
}
.delete-btn {
	color: #dc3545;
	border-color: #dc3545;
}
.delete-btn:hover {
	background-color: rgba(220, 53, 69, 0.1);
}

.table-container {
	width: 100%;
}
table {
	border-collapse: separate;
	border-spacing: 0 8px;
	width: 100%;
}
th, td {
	padding: 8px;
	text-align: center;
	vertical-align: middle;
}
td {
	position: relative;
}
.main-container {
  display: flex;
  gap: 20px;
}

.form-container {
  flex: 1;
  max-width: 400px;
}

.table-container {
  flex: 1;
  max-width: 600px;
  margin-top: 20px;
}

.admin-table {
  background: #222;
  padding: 12px;
  border-radius: 8px;
  color: var(--text-color2);
}

.admin-table table {
  width: 100%;
}

.admin-table th, .admin-table td {
  font-size: 14px;
  padding: 10px;
}

.table-header h3 {
  font-size: 18px;
  color: var(--text-color2);
}

.delete-btn {
  padding: 4px 8px;
  font-size: 12px;
  color: #dc3545;
  border: 1px solid #dc3545;
  border-radius: 4px;
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
      <h1>Create Admin</h1>
    </div>
  </div>
  <div class="main-container">
    <div class="form-container">
      <form id="addUserForm" enctype="multipart/form-data">
        <label for="name">Username:</label>
        <input type="text" id="name" name="name" placeholder="Enter username" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" placeholder="Enter e-mail" required>

        <label for="dob">Date of Birth:</label>
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

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>

        <label for="confirm-password">Confirm password:</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm password" required>

        <button type="submit">Add Admin</button>
      </form>
    </div>
    
    <div class="table-container">
  <div class="admin-table">
    <div class="table-header">
      <h3>Admin List</h3>
    </div>
    <table>
      <thead>
        <tr>
          <th>Username</th>
          <th>E-mail</th>
          <th>Date of Birth</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody id="orderList">
        <tr>
          <td>John Doe</td>
          <td>johndoe@example.com</td>
          <td>1987-04-12</td>
          <td>
            <button class="delete-btn">
              <i class='bx bxs-trash'></i> Delete
            </button>
          </td>
        </tr>
        <tr>
          <td>Jane Smith</td>
          <td>janesmith@example.com</td>
          <td>1995-08-22</td>
          <td>
            <button class="delete-btn">
              <i class='bx bxs-trash'></i> Delete
            </button>
          </td>
        </tr>
        <tr>
          <td>Alice John</td>
          <td>alicejohn@example.com</td>
          <td>2001-11-30</td>
          <td>
            <button class="delete-btn">
              <i class='bx bxs-trash'></i> Delete
            </button>
          </td>
        </tr>
        <tr>
          <td>Bob Brown</td>
          <td>bobbrown@example.com</td>
          <td>1990-02-05</td>
          <td>
            <button class="delete-btn">
              <i class='bx bxs-trash'></i> Delete
            </button>
          </td>
        </tr>
      </tbody>                  
    </table>
  </div>
</div>
</main>
<script src="../Assets/js/admin.js"></script>
</body>
</html>
