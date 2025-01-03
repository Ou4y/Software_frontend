<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/LoginSignup.css">
    <title>Login Page</title>
    <style>
        /* Basic styles for the alert */
        .alert {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .alert.error {
            background-color: #f44336; /* Red for error */
            color: white;
        }
        .alert.success {
            background-color: #4CAF50; /* Green for success */
            color: white;
        }
    </style>
</head>
<body>

<?php 
require_once('../../Controllers/AuthController.php');

include('../includes/header.php'); 
?>

<div class="auth-wrapper">
    <div class="auth-container" id="auth-container">
        <!-- Sign Up Form -->
        <div class="auth-form signup-form">
            <form id="signUpForm" method="POST">
                <input type="hidden" name="form_type" value="signUpForm">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <input type="text" id="username" placeholder="Username" name="username" required>
                <input type="email" id="email" placeholder="Email" name="email" required>
                <input type="password" id="password" placeholder="Password" name="password" required>
                <input type="text" id="phone_number" placeholder="Phone Number" name="phone_number" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>

        <!-- Sign In Form -->
        <div class="auth-form signin-form">
            <form id="signInForm" method="POST">
                <input type="hidden" name="form_type" value="signInForm">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <input type="email" id="signInEmail" placeholder="Email" name="email" required>
                <input type="password" id="signInPassword" placeholder="Password" name="password" required>
                <a href="#">Forget Your Password?</a>
                <br><br>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="auth-toggle-container">
            <div class="auth-toggle">
                <div class="auth-panel auth-panel-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of the site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="auth-panel auth-panel-right">
                    <h 1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of the site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/Footer.php'); ?>

<script>
    const container = document.querySelector('.auth-container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });

    // Function to show alert
    function showAlert(message, type) {
        const alertBox = document.createElement('div');
        alertBox.className = 'alert ' + type; // Add type for success or error
        alertBox.innerText = message;
        document.body.appendChild(alertBox);
        alertBox.style.display = 'block';

        // Automatically hide the alert after 3 seconds
        setTimeout(() => {
            alertBox.style.display = 'none';
            document.body.removeChild(alertBox);
        }, 3000);
    }

    // Check for error messages in PHP session
    <?php if (isset($_SESSION['error_message'])): ?>
        showAlert("<?php echo $_SESSION['error_message']; ?>", 'error');
        <?php unset($_SESSION['error_message']); // Clear the message after displaying ?>
    <?php endif; ?>

    // Check for success messages in PHP session
    <?php if (isset($_SESSION['success_message'])): ?>
        showAlert("<?php echo $_SESSION['success_message']; ?>", 'success');
        <?php unset($_SESSION['success_message']); // Clear the message after displaying ?>
    <?php endif; ?>
</script>

</body>
</html>