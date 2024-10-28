<?php
include_once '../includes/db_connection.php';

if (isset($_GET['ID'])) {
    $userId = intval($_GET['ID']);

    $sql = "SELECT Username, Email, Phone FROM customer WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "No user ID specified.";
    exit;
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

      
      <h1>Edit User</h1>
     <form action="" method="POST">
        <input type="hidden" name="ID" value="<?php echo htmlspecialchars($userId); ?>">
        <label for="username">Username:</label>
        <input type="text" name="Username" value="<?php echo htmlspecialchars($user['Username']); ?>" required>
        
        <label for="email">E-mail:</label>
        <input type="email" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
        
        <label for="phone">Phone Number:</label>
        <input type="text" name="Phone" value="<?php echo htmlspecialchars($user['Phone']); ?>" required>
        
        <button type="submit">Update User</button>
    </form>
      
      </main>
    </main>
  </section>
  <script src="../Assets/js/admin.js"></script>
</body>
</html>

<?php
include_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['ID']);
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $sql = "UPDATE customer SET Username = ?, Email = ?, Phone = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $phone, $userId);

    if ($stmt->execute()) {
        header("Location: ManageUsers.php");
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
?>