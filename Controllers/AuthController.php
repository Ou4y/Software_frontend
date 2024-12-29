<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../Models/DataBase.php');

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $dbConnection = Database::getInstance()->getConnection();
        $this->userModel = new User($dbConnection);
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $formType = isset($_POST['form_type']) ? htmlspecialchars($_POST['form_type']) : '';

            if ($formType === 'signUpForm') {
                $this->handleSignUp();
            } elseif ($formType === 'signInForm') {
                $this->handleSignIn();
            }
        }
    }

    private function handleSignUp()
{
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $phoneNumber = htmlspecialchars($_POST['phone_number']);

    // Validate input
    if ($this->userModel->usernameExists($username)) {
        $_SESSION['error_message'] = "Username already exists. Please choose a different username.";
        return; // Return instead of redirecting
    }

    if (!$this->userModel->isValidEmail($email)) {
        $_SESSION['error_message'] = "Invalid email format. Please enter a valid email.";
        return;
    }

    if ($this->userModel->emailExists($email)) {
        $_SESSION['error_message'] = "Email already exists. Please choose a different email.";
        return;
    }

    if (!$this->userModel->isValidPhoneNumber($phoneNumber)) {
        $_SESSION['error_message'] = "Phone number must be exactly 11 digits.";
        return;
    }

    if ($this->userModel->phoneNumberExists($phoneNumber)) {
        $_SESSION['error_message'] = "Phone number already exists. Please choose a different phone number.";
        return;
    }

    if (!$this->userModel->isValidPassword($password)) {
        $_SESSION['error_message'] = "Password must be at least 8 characters long and contain at least one number.";
        return;
    }

    // If all validations pass, proceed to sign up
    if ($this->userModel->signUp($username, $email, $password, $phoneNumber)) {
        $_SESSION['success_message'] = "Account created successfully!";
        header("Location: ../public/LoginSignup.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error: Unable to create account.";
        return;
    }
}
private function handleSignIn()
{
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Validate email format
    if (!$this->userModel->isValidEmail($email)) {
        $_SESSION['error_message'] = "Invalid email format. Please enter a valid email.";
        return; // Return instead of redirecting
    }

    // Check if email and password are correct
    $user = $this->userModel->signIn($email, $password);
    if ($user) {
        $_SESSION['user'] = $user;  // Store user data in session
        // Redirect to the appropriate dashboard based on user type
        if ($user['user_type'] === 'admin') {
            header("Location: ../public/admin.php");
        } else {
            header("Location: ../public/index.php");
        }
        exit();
    } else {
        $_SESSION['error_message'] = "Email or password might be wrong.";
        return; // Return instead of redirecting
    }
}
}

// Call the handleRequest method to process form submissions
$authController = new AuthController();
$authController->handleRequest();
?>