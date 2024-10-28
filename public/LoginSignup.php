<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/LoginSignup.css">
    <title> Login Page </title>
    
</head>
<body>



<?php include('../includes/header.php'); ?>

<?php

session_start(); // Start the session to access session variables

// Check for error messages
if (isset($_SESSION['error_message'])) {
    echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
    unset($_SESSION['error_message']); // Clear the message after displaying it
}
?>


<div class="fieldlogsign">
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="signUpForm" method="POST" action="../includes/db_connection.php">
            <input type="hidden" name="form_type" value="sign_up">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" id="signUpUsername" placeholder="Username" name="username" required>
                <input type="email" id="signUpEmail" placeholder="Email" name="email" required>
                <input type="password" id="signUpPassword" placeholder="Password" name="password" required>
                <input type="password" id="PhoneNumber" placeholder="Phone Number" name="Number" required>
                <button type="submit">Sign Up</button> 
            </form>
        </div>
        <div class="form-container sign-in">
            <form id="signInForm" method="POST" action="../includes/db_connection.php">
            <input type="hidden" name="form_type" value="sign_in">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" id="signInEmail" placeholder="Email" name="email" required>
                <input type="password" id="signInPassword" placeholder="Password" name="password" required>
                <a href="#">Forget Your Password?</a>
                <br><br>
                Admin: <input type="checkbox" name="type" value="yes">
                <button type="submit">Sign In</button>
                <br>
                
            </form>
            
              


        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of the site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of the site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
</div>
    </div>
    <script>
        const container = document.getElementById('container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');

        // Toggle between Register and Login forms
        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

        // Validation for Sign In Form
        document.getElementById('signInForm').addEventListener('submit', (e) => {
            const email = document.getElementById('signInEmail').value;
            const password = document.getElementById('signInPassword').value;

            if (!email || !password) {
                alert('Please fill in all required information.');
                e.preventDefault();
                return;
            }

            // Simple email validation using includes
            if (!email.includes('@') || !email.includes('.')) {
                alert('Please enter a valid email address.');
                e.preventDefault();
                return;
            }

            if (password.length < 8 || !/\d/.test(password)) {
                alert('Password must contain at least one number and be at least 8 characters long.');
                e.preventDefault();
                return;
            }
        });

        // Validation for Sign Up Form
        document.getElementById('signUpForm').addEventListener('submit', (e) => {
            const email = document.getElementById('signUpEmail').value;
            const password = document.getElementById('signUpPassword').value;
            const username = document.getElementById('signUpUsername').value;

            if (!email || !password || !username) {
                alert('Please fill in all required information.');
                e.preventDefault();
                return;
            }

            // Simple email validation using includes
            if (!email.includes('@') || !email.includes('.')) {
                alert('Please enter a valid email address.');
                e.preventDefault();
                return;
            }

            if (password.length < 8 || !/\d/.test(password)) {
                alert('Password must contain at least one number and be at least 8 characters long.');
                e.preventDefault();
                return;
            }
        });
    </script>

    <?php include('../includes/Footer.php'); ?>

    </body>
</html>