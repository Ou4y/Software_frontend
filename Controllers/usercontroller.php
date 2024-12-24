<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../DataBase.php');
require_once(__DIR__ . '/../Models/owners.php');

class manageuser
{
    private $owner;
    private $user;

    public function __construct()
    {
        // Create a database connection
        $dbConnection = (new Database())->getConnection();

        // Now pass the connection to the User class constructor
        $this->owner = new Owners($dbConnection);
        $this->user = new User($dbConnection); // Add this

    }
    public function deleteUser()
    {
        header('Content-Type: application/json'); // Ensure JSON response
        try {
            // Check if the request is POST and an ID is provided
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                $userId = htmlspecialchars($_POST['id']); // Sanitize the input
                if ($this->owner->deleteuser($userId)) {
                    echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
                } else {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                }
                catch (Exception $e) {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                }
            } 



            public function addadmin()
            {
                $username = htmlspecialchars($_POST['username']);
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $phoneNumber = htmlspecialchars($_POST['phone_number']);
        
                if ($this->owner->addadmin($username, $email, $password, $phoneNumber)) {
                    $_SESSION['success_message'] = "Account created successfully!";
                    header("Location: ../public/createAdmin.php");
                    exit(); // Always include an exit after header redirection
                } else {
                    $_SESSION['error_message'] = "Error: Unable to create account.";
                    header("Location: ../public/createAdmin.php");
                    exit(); // Always include an exit after header redirection
                }

            }

            

            
   



    public function getAllUsers()
    {
        return $this->user->getAllUsers();
    }

    public function getadmin()
    {
        return $this->user->getadmin();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manageUser = new ManageUser();
    $manageUser->deleteUser();
    exit; 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['name']) &&
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['phone_number'])) {
    $manageUser = new ManageUser();
    $manageUser->addAdmin();
    exit;
}

    ?>