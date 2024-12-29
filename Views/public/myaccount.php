<?php
require_once('../../Controllers/usercontroller.php');

// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: LoginSignup.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$manageuser = new manageuser();
$currentUser = $manageuser->getUserDetails($userId);
$userOrders = $manageuser->getUserOrders($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  $_POST['action'] === 'editClient') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phoneNumber = htmlspecialchars($_POST['phone_number']);

    if ($manageuser->editclient($userId, $username, $email, $phoneNumber)) {
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: myaccount.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Failed to update profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Fashion Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --ma-primary: #1a1a1a;
            --ma-secondary: #333;
            --ma-accent: #ff4444;
            --ma-background: #ffffff;
            --ma-text: #333333;
            --ma-muted: #666666;
            --ma-border: #e5e5e5;
            --ma-shadow: rgba(0, 0, 0, 0.1);
            --ma-danger: #dc2626;
        }

        .ma-wrapper * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .ma-wrapper {
            font-family: 'Inter', sans-serif;
            line-height: 1.5;
            color: var(--ma-text);
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .ma-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .ma-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ma-header-left {
            flex: 1;
        }

        .ma-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .ma-subtitle {
            color: var(--ma-muted);
        }

        .ma-logout-btn {
            padding: 0.75rem 1.5rem;
            background: var(--ma-danger);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: opacity 0.3s;
        }

        .ma-logout-btn:hover {
            opacity: 0.9;
        }

        .ma-form-grid {
            display: grid;
            gap: 1.5rem;
        }

        .ma-form-group {
            display: grid;
            gap: 0.5rem;
        }

        .ma-form-label {
            font-weight: 500;
        }

        .ma-form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--ma-border);
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .ma-form-input:focus {
            outline: none;
            border-color: var(--ma-primary);
        }

        .ma-btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .ma-btn-outline {
            background: transparent;
            border: 2px solid var(--ma-border);
            color: var(--ma-text);
        }

        .ma-btn-outline:hover {
            border-color: var(--ma-primary);
            color: var(--ma-primary);
        }

        .ma-order-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 20px;
        }

        .ma-order-item {
            border: 1px solid var(--ma-border);
            border-radius: 4px;
            padding: 1rem;
            background-color: #fff;
            box-shadow: 0 2px 4px var(--ma-shadow);
        }

        .ma-order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .ma-order-number {
            font-weight: 600;
        }

        .ma-order-info p {
            margin: 0.5rem 0;
        }

        .ma-section-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    <div class="ma-wrapper">
        <div class="ma-container">
            <header class="ma-header">
                <div class="ma-header-left">
                    <h1 class="ma-title">My Account</h1>
                    <p class="ma-subtitle">Welcome back, <?php echo htmlspecialchars($currentUser['username']); ?>!</p>
                </div>
                <button class="ma-logout-btn" onclick="logout()">Logout</button>
            </header>

            <!-- Profile Form -->
            <form method="POST" action="myaccount.php">
                <input type="hidden" name="action" value="editClient">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($currentUser['id']); ?>">
                <div class="ma-form-grid">
                    <div class="ma-form-group">
                        <label class="ma-form-label">Name</label>
                        <input type="text" class="ma-form-input" name="username" value="<?php echo htmlspecialchars($currentUser['username']); ?>" required>
                    </div>
                    <div class="ma-form-group">
                        <label class="ma-form-label">Email</label>
                        <input type="email" class="ma-form-input" name="email" value="<?php echo htmlspecialchars($currentUser['email']); ?>" required>
                    </div>
                    <div class="ma-form-group">
                        <label class="ma-form-label">Phone</label>
                        <input type="text" class="ma-form-input" name="phone_number" value="<?php echo htmlspecialchars($currentUser['phone_number']); ?>" required>
                        <br>
                    </div>
                </div>
                <button type="submit" class="ma-btn ma-btn-outline">Save Changes</button>
            </form>
            <br>
            <!-- Orders Section -->
            <section class="ma-section">
                <h2 class="ma-section-title">My Orders</h2>
                <?php if (!empty($userOrders)) : ?>
                    <div class="ma-order-list">
                        <?php foreach ($userOrders as $order) : ?>
                            <div class="ma-order-item">
                                <div class="ma-order-header">
                                    <span class="ma-order-number">Order #<?php echo htmlspecialchars($order['id']); ?></span>
                                    <span class="ma-order-date"><?php echo htmlspecialchars($order['order_date']); ?></span>
                                </div>
                                <div class="ma-order-info">
                                    <p>Total Amount: $<?php echo htmlspecialchars($order['total_amount']); ?></p>
                                    <p>Status: <?php echo htmlspecialchars($order['status']); ?></p>
                                    <p>Address: <?php echo htmlspecialchars($order['Address']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p>No orders found.</p>
                <?php endif; ?>
            </section>
        </div>
    </div>
    <script>
        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = '../public/logout.php';
            }
        }
    </script>
</body>
</html>
