<?php 
require_once('../../Controllers/usercontroller.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['Submit'])) {
      $manageuser = new manageuser();
      
      $result = $manageuser->addadmin(); 

      if ($result) {
          echo json_encode(['success' => true, 'message' => 'Admin added successfully.']);
      } else {
          echo json_encode(['success' => false, 'message' => 'Failed to add admin.']);
      }
      exit; 
  }
}


$manageuser = new manageuser();
$users = $manageuser->getadmin();
if (isset($_POST['deleteUser']) && is_object($users)) {
  $users->deleteUser($_POST['id']); // Delete a user
}
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
      <a  href='logout.php' class="logout-btn"><i class='bx bx-log-out'></i>Logout</a>
    </nav>

<main>
  <div class="head-title">
    <div class="left">
      <h1>Create Admin</h1>
    </div>
  </div>
  <div class="main-container">
    <div class="form-container">
      <form id="addUserForm"  method="POST">
      <input type="hidden" name="action" value="addAdmin"><!-- Action Parameter -->
      <label for="name">Username:</label>
    <input type="text" id="username" name="username" placeholder="Enter username" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" placeholder="Enter e-mail" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter password" required>

    <label for="phone">Phone Number:</label>
    <input type="number" id="phone_number" name="phone_number" placeholder="Enter Phone Number" required>     
        <button type="submit" >Add Admin</button>
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
              <th>Phone</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody id="orderList">
            <?php 
            if (!empty($users)) {
              foreach ($users as $user) {
                echo "<tr data-id='" . htmlspecialchars($user['id']) . "'>";
                echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['phone_number']) . "</td>";
                echo "<td>
                        <button class='delete-btn' name='deleteUser' onclick=\"confirmDelete('" . htmlspecialchars($user['id']) . "')\">
                          <i class='bx bxs-trash'  ></i> Delete
                        </button>
                      </td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<script>
function confirmAddAdmin() {
    if (confirm("Are you sure you want to add this admin?")) {
        document.getElementById("addUserForm").submit();
    }
}







 
function confirmDelete(userId) {
    if (!userId) {
        alert("Invalid user ID.");
        return;
    }

    if (confirm("Are you sure you want to delete this admin?")) {
        fetch(window.location.href, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=deleteUser&id=${encodeURIComponent(userId)}`
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    throw new Error(`Error: ${response.status} - ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert("Admin deleted successfully.");
                const userRow = document.querySelector(`tr[data-id='${userId}']`);
                if (userRow) userRow.remove();
            } else {
                alert(data.message || "Failed to delete admin.");
            }
        })
        .catch(error => {
            alert("An error occurred: " + error.message);
            console.error("Error:", error);
        });
    }
}

</script>
<script src="../Assets/js/admin.js"></script>
</body>
</html>



