<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: LoginSignup.php");
    exit();
}

// Assuming session data contains user information
$user = $_SESSION['user']; // The user ID or username

// Fetch additional session data if available
$userName = isset($_SESSION['userName']) ? $_SESSION['userName'] : '';
$userEmail = isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : '';
$userPhone = isset($_SESSION['userPhone']) ? $_SESSION['userPhone'] : '';

// You can now use these variables like $userName, $userEmail, etc.
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
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

        /* Tabs */
        .ma-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--ma-border);
            padding-bottom: 0.5rem;
        }

        .ma-tab {
            padding: 0.75rem 1.5rem;
            color: var(--ma-text);
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .ma-tab:hover {
            background: #f8f9fa;
        }

        .ma-tab.ma-active {
            color: var(--ma-primary);
            font-weight: 500;
            position: relative;
        }

        .ma-tab.ma-active::after {
            content: '';
            position: absolute;
            bottom: -0.6rem;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--ma-primary);
        }

        /* Content Sections */
        .ma-section {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px var(--ma-shadow);
            margin-bottom: 1.5rem;
        }

        .ma-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--ma-border);
        }

        .ma-section-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        /* Form */
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

        /* Orders */
        .ma-order-list {
            display: grid;
            gap: 1rem;
        }

        .ma-order-item {
            border: 1px solid var(--ma-border);
            border-radius: 4px;
            padding: 1rem;
        }

        .ma-order-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .ma-order-number {
            font-weight: 600;
        }

        .ma-order-date {
            color: var(--ma-muted);
        }

        .ma-order-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 500;
            background: #dcfce7;
            color: #166534;
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

        @media (max-width: 768px) {
            .ma-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .ma-tabs {
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                padding-bottom: 0.5rem;
            }

            .ma-tab {
                padding: 0.75rem 1rem;
            }
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
                    <p class="ma-subtitle">Welcome back, John</p>
                </div>
                <button class="ma-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </header>

            <div class="ma-tabs">
                <a href="#profile" class="ma-tab ma-active">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
                <a href="#orders" class="ma-tab">
                    <i class="fas fa-shopping-bag"></i>
                    Orders
                </a>
                <a href="#settings" class="ma-tab">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
            </div>

            <!-- Profile Section -->
            <section class="ma-section">
                <div class="ma-section-header">
                    <h2 class="ma-section-title">Profile Information</h2>
                    <button class="ma-btn ma-btn-outline">Edit</button>
                </div>
                <div class="ma-form-grid">
                    <div class="ma-form-group">
                        <label class="ma-form-label">Name</label>
                        <input type="text" class="ma-form-input" value="John Doe" disabled>
                    </div>
                    <div class="ma-form-group">
                        <label class="ma-form-label">Email</label>
                        <input type="email" class="ma-form-input" value="john.doe@example.com" disabled>
                    </div>
                    <div class="ma-form-group">
                        <label class="ma-form-label">Phone</label>
                        <input type="tel" class="ma-form-input" value="+1 (555) 123-4567" disabled>
                    </div>
                </div>
            </section>

            <!-- Recent Orders -->
            <section class="ma-section">
                <div class="ma-section-header">
                    <h2 class="ma-section-title">Recent Orders</h2>
                </div>
                <div class="ma-order-list">
                    <div class="ma-order-item">
                        <div class="ma-order-header">
                            <span class="ma-order-number">#ORD-2024-001</span>
                            <span class="ma-order-date">Jan 15, 2024</span>
                        </div>
                        <div class="ma-order-info">
                            <p>Premium Winter Jacket</p>
                            <p>Total: $299.00</p>
                        </div>
                        <span class="ma-order-status">Delivered</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include('../includes/Footer.php'); ?>
    <script>
        // Tab Navigation
        document.querySelectorAll('.ma-tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                document.querySelectorAll('.ma-tab').forEach(t => t.classList.remove('ma-active'));
                tab.classList.add('ma-active');
            });
        });

        // Edit Profile
        document.querySelector('.ma-btn-outline').addEventListener('click', function() {
            const inputs = document.querySelectorAll('.ma-form-input');
            const isEditing = this.textContent === 'Edit';
            
            inputs.forEach(input => input.disabled = !isEditing);
            this.textContent = isEditing ? 'Save' : 'Edit';
            
            if (!isEditing) {
                alert('Profile updated successfully!');
            }
        });

        // Logout
        document.querySelector('.ma-logout-btn').addEventListener('click', () => {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logged out successfully!');
                window.location.href = '../public/logout.php';
                }
        });
    </script>
</body>
</html>