<?php 
session_start(); // Start the session

require_once('../../Controllers/usercontroller.php');

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Submit'])) {
        $manageuser = new manageuser();
        
        $result = $manageuser->addNormalUser (); 

        if ($result) {
            $_SESSION['success_message'] = 'User  added successfully.'; // Set success message
        } else {
            $_SESSION['error_message'] = 'Failed to add user.'; // Set error message
        }
        // Redirect to the same page to avoid form resubmission
        header('Location: ' . $_SERVER['PHP_SELF']); 
        exit; 
    }
}

// Check for session messages
if (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
    $messageType = 'error';
    unset($_SESSION['error_message']); // Clear the message after displaying it
}

if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message']; // Store success message separately
    unset($_SESSION['success_message']); // Clear the message after displaying it
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
  <title>Add User</title>
</head>
<style>
  .modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.4); 
  padding-top: 60px; 
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* Adjusted margin for vertical centering */
  padding: 15px; /* Reduced padding */
  border: 1px solid #888;
  width: 40%; /* Adjusted width to make it smaller */
  max-width: 400px; /* Set a maximum width */
  border-radius: 8px; /* Optional: Add rounded corners */
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
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
          <h1>Add user</h1>
        </div>
      </div>
      <main>
        <form id="addUserForm"  method="post">
        <input type="hidden" name="action" value="addNormalUser">
          <label for="name">Username:</label>
          <input type="text" id="username" name="username" placeholder="Enter username" required>
      
          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" placeholder="Enter e-mail" required>
       
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Enter password" required>
      
          <label for="confirm-password">Phone Number:</label>
          <input type="number" id="phone_number" name="phone_number" placeholder="Enter Phone Number" required>     
          <button type="submit" >Add User</button>
          </form>
         <!-- Modal -->
<div id="messageModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <p id="modalMessage"></p>
  </div>
</div>
    </main>
    <script src="../Assets/js/admin.js"></script>
    <script>
  // Function to show the modal
  function showModal(message) {
    const modal = document.getElementById("messageModal");
    const modalMessage = document.getElementById("modalMessage");
    
    modalMessage.textContent = message;
    modal.style.display = "block";
  }

  // Close the modal when the user clicks on <span> (x)
  document.getElementById("closeModal").onclick = function() {
    document.getElementById("messageModal").style.display = "none";
  }

  // Close the modal when the user clicks anywhere outside of the modal
  window.onclick = function(event) {
    const modal = document.getElementById("messageModal");
    if (event.target === modal) {
      modal.style.display = "none";
    }
  }

  // Show the modal if there's an error message
  <?php if (isset($message) && !empty($message)): ?>
    showModal("<?php echo addslashes($message); ?>");
  <?php endif; ?>
</script>
</body>
</html>

