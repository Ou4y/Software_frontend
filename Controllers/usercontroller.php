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
        error_log("deleteUser called."); // Log entry for debugging
        header('Content-Type: application/json'); // Ensure JSON response
        try {
            // Check if the request is POST and an ID is provided
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                $userId = htmlspecialchars($_POST['id']); // Sanitize the input
                error_log("deleteUser called with ID: $userId"); // Log for debugging

                if ($this->owner->deleteUser($userId)) {
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
                error_log("addAdmin called."); // Log entry for debugging
                header('Content-Type: application/json'); // Ensure JSON response
                try {
                    // Check if the request is POST and an ID is provided     
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
                catch (Exception $e) {
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        header('Content-Type: application/json');
    
        $action = $_POST['action'] ?? null;
        $id = $_POST['id'] ?? null;
    
        if ($action === 'deleteUser' && $id) {
            try {
                $manageuser = new manageuser();
                $result = $manageuser->deleteUser($id);
    
                if ($result) {
                    echo json_encode(['success' => true, 'message' => 'Admin deleted successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to delete admin.']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
        }
        exit;
    }
    
     elseif ($action === 'addAdmin' &&
        isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone_number'])) {
        // Debugging: Log addAdmin request
        error_log("Routing to addAdmin for username: " . $_POST['username']);
        try {
            $manageUser->addAdmin();
        } catch (Exception $e) {
            error_log("Error in addAdmin: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        // Invalid request
        http_response_code(400);
        $errorMessage = 'Invalid request. ';
        $errorMessage .= $action === null ? 'Missing action parameter. ' : '';
        $errorMessage .= !isset($_POST['id']) && $action === 'deleteUser' ? 'Missing ID for deleteUser. ' : '';
        echo json_encode(['success' => false, 'message' => $errorMessage]);
        error_log("Invalid request: " . $errorMessage);
    }
    exit;
}




    ?>