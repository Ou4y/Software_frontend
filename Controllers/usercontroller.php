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
        $this->user = new User($dbConnection); 
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
                throw new Exception("Invalid request. ID not provided.");
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }




    public function addadmin()
{
    error_log("addAdmin called."); 

    try {
        // Check if the request is POST and all required data is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone_number'])) {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $phoneNumber = htmlspecialchars($_POST['phone_number']);

            // Add the admin via the Owners model
            if ($this->owner->addadmin($username, $email, $password, $phoneNumber)) {
                // Redirect with success message
                $_SESSION['success_message'] = "Admin added successfully.";
                header("Location: ../public/createAdmin.php"); // Replace with your actual redirect page
                exit;
            } else {
                throw new Exception("Failed to add admin.");
            }
        } else {
            throw new Exception("Invalid input data.");
        }
    } catch (Exception $e) {
        // Redirect with error message
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: /your-redirect-page"); // Replace with your actual redirect page
        exit;
    }
}


public function addNormalUser()
{
    error_log("addNormalUser called."); // Log entry for debugging

    try {
        // Check if the request is POST and all required data is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone_number'])) {
            $userId = htmlspecialchars($_POST['id']); // Sanitize the input
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $phoneNumber = htmlspecialchars($_POST['phone_number']);

            // Add the normal user via the Owners model
            if ($this->owner->addNormalUser($username, $email, $password, $phoneNumber)) {
                // Redirect with success message
                $_SESSION['success_message'] = "User edited successfully.";
                header("Location: ../public/ManageUsers.php"); // Correct redirect path for adding normal users
                exit;
            } else {
                throw new Exception("Failed to add user.");
            }
        } else {
            throw new Exception("Invalid input data.");
        }
    } catch (Exception $e) {
        // Redirect with error message
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: ../public/AdminDashboard.php"); // Replace with a proper error handling page
        exit;
    }
}

public function edituser(){
    error_log("edit user called."); // Log entry for debugging

    try {
        // Check if the request is POST and all required data is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'],$_POST['username'], $_POST['email'], $_POST['phone_number'])) {
            $userId = htmlspecialchars($_POST['id']); // Sanitize the input
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $phoneNumber = htmlspecialchars($_POST['phone_number']);
            error_log("Input data: userId=$userId, username=$username, email=$email, phoneNumber=$phoneNumber");

            // Add the normal user via the Owners model
            if ($this->owner->edituser($userId,$username, $email, $phoneNumber)) {
                echo json_encode(['success' => true, 'message' => 'User updated successfully.']);
                header("Location: ../public/ManageUsers.php"); // Correct redirect path for adding normal users
                return;
            } else {
                throw new Exception("Failed to add user.");
            }
        } else {
            throw new Exception("Invalid input data.");
        }
    } catch (Exception $e) {
        // Redirect with error message
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: ../public/editUser.php"); // Replace with a proper error handling page
        exit;
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

    public function getUserDetails($userId)
{
    return $this->user->getUserById($userId);
}

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $action = $_POST['action'] ?? null;
    $id = $_POST['id'] ?? null;

    $manageuser = new manageuser();

    if ($action === 'deleteUser' && $id) {
        try {
            $manageuser->deleteUser();
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    } elseif ($action === 'addAdmin' &&
        isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone_number'])) {
        try {
            error_log("Routing to addAdmin for username: " . $_POST['username']);
            $manageuser->addadmin();
        } catch (Exception $e) {
            error_log("Error in addAdmin: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } elseif ($action === 'addNormalUser' &&
        isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone_number'])) {
        try {
            error_log("Routing to addNormalUser for username: " . $_POST['username']);
            $manageuser->addNormalUser();
        } catch (Exception $e) {
            error_log("Error in addNormalUser: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
           
    } elseif ($action === 'edituser' &&
    isset($_POST['id'], $_POST['username'], $_POST['email'], $_POST['phone_number'])) {
        try {
            error_log("Routing to editUser for ID: " . $_POST['id']);
            $manageuser->edituser();
        } catch (Exception $e) {
            error_log("Error in editUser: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
}

    
    else {
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
