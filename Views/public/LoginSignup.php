<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../Assets/css/LoginSignup.css">
    <title>Login Page</title>
</head>
<body>

<?php 
require_once('../../Controllers/AuthController.php');

include('../includes/header.php'); 
?>
<div class="fieldlogsign">
    <div class="container" id="container">
        <!-- Sign Up Form -->
        <div class="form-container sign-up">
            <form id="signUpForm" method="POST" >
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
        <div class="form-container sign-in">
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

<?php include('../includes/Footer.php'); ?>

<script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
    
</script>

<script src="../Assets/js/LoginSignup.js"></script>

</body>
</html>
