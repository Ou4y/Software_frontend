<?php
require_once(__DIR__ . '/../Models/User.php');
require_once (__DIR__ . '/../Models/DataBase.php');

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $dbConnection = Database::getInstance()->getConnection();

        // Now pass the connection to the User class constructor
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

        if ($this->userModel->signUp($username, $email, $password, $phoneNumber)) {
            $_SESSION['success_message'] = "Account created successfully!";
            header("Location: ../public/LoginSignup.php");
            exit(); // Always include an exit after header redirection
        } else {
            $_SESSION['error_message'] = "Error: Unable to create account.";
            header("Location: ../public/LoginSignup.php");
            exit(); // Always include an exit after header redirection
        }
    }

    private function handleSignIn()
    {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        
        $user = $this->userModel->signIn($email, $password);
        if ($user) {
            $_SESSION['user'] = $user;  // Store user data in session
            // Redirect to the appropriate dashboard based on user type
            if ($user['user_type'] === 'admin') {
                header("Location: ../public/admin.php");
            } else {
                header("Location: ../public/index.php");
            }
            exit(); // Always include an exit after header redirection
        } else {
            $_SESSION['error_message'] = "Invalid email or password.";
            header("Location: ../public/LoginSignup.php");
            exit(); // Always include an exit after header redirection
        }
    }
    

}

// Call the handleRequest method to process form submissions
$authController = new AuthController();
$authController->handleRequest();

?>
