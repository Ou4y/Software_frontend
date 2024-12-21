<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../Models/Database.php');

class AuthController
{
    private $userModel;

    public function __construct()
    {
        // Use Database Singleton to get the connection
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
        $isAdmin = isset($_POST['type']) ? 'Yes' : 'No';

        $user = $this->userModel->signIn($email, $password);
        if ($user) {
            $_SESSION['user'] = $user;
            $redirectPage = $isAdmin === 'Yes' ? '../public/admin.php' : '../public/myaccount.php';
            header("Location: $redirectPage");
            exit(); // Always include an exit after header redirection
        } else {
            $_SESSION['error_message'] = $isAdmin === 'Yes' ? "Admin not found!" : "Customer not found!";
            header("Location: ../public/LoginSignup.php");
            exit(); // Always include an exit after header redirection
        }
    }
}
?>
