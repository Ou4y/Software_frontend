<?php
session_start(); // Start the session
if (!isset($_SESSION['user'])) {
    header("Location: LoginSignup.php");
    exit();
}

require_once('../../Controllers/usercontroller.php');

// Initialize variables
$username = '';
$email = '';
$phoneNumber = '';
$userId = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['ID'])) {
    $userId = intval($_GET['ID']); // Sanitize the ID
    $manageuser = new manageuser();
    $userDetails = $manageuser->getUserDetails($userId);

    if ($userDetails) {
        $username = htmlspecialchars($userDetails['username']);
        $email = htmlspecialchars($userDetails['email']);
        $phoneNumber = htmlspecialchars($userDetails['phone_number']);
    } else {
        die("User not found."); // Handle the case when the user doesn't exist
    }
}

// Handle the form submission for updating user details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'edituser') {
        $manageuser = new manageuser();
        $result = $manageuser->edituser();

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'User edited successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to edit user.']);
        }
        exit;
    }
}
?>
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
          <h1>Edit User</h1>
        </div>
      </div>
      <main>
        <h1>Edit User</h1>
        <form id="editUserForm" method="POST" action="">
          <input type="hidden" name="action" value="edituser">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($userId); ?>">

          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

          <label for="phone_number">Phone Number:</label>
          <input type="text" id="phone_number" name="phone_number" value="<?php echo $phoneNumber; ?>" required>

          <button type="submit">Update User</button>
        </form>
      </main>
    </main>
  </section>
  <script src="../Assets/js/admin.js"></script>
</body>
</html>
