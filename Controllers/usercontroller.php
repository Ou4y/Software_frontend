<?php
require_once(__DIR__ . '/../Models/User.php');
require_once (__DIR__ . '/../Models/DataBase.php');
require_once(__DIR__ . '/../Models/owners.php');
require_once(__DIR__ . '/../Models/UserFactory.php');

class manageuser
{
    private Owners $owner;
    private User  $user;
    private PDO  $dbConnection;
    private client $client;


    public function __construct()
    {
        // Create a database connection
        $this->dbConnection = Database::getInstance()->getConnection();

        // Create user objects using the Factory
        $this->owner = UserFactory::create('owners');
        $this->user = UserFactory::create('user');
        $this->client = UserFactory::create('client');
    }

    public function deleteUser()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $userId = htmlspecialchars($_POST['id']);

        if ($this->owner->deleteUser($userId)) {
            echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid request: ID not provided.']);
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

           // Check if the username already exists
           if ($this->owner->usernameExists($username)) {
            // Check if the existing username is of a different type
            $existingUserType = $this->owner->getUserTypeByUsername($username);
            if ($existingUserType === 'admin') {
                $_SESSION['error_message'] = "Username already exists for an admin. Please choose a different username.";
                header("Location: ../public/createAdmin.php"); // Redirect back to the add admin form
                exit;
            }
        }

            // Check if the email is valid
            if (!$this->owner->isValidEmail($email)) {
                $_SESSION['error_message'] = "Invalid email format. Please enter a valid email.";
                header("Location: ../public/createAdmin.php"); // Redirect back to the add admin form
                exit;
            }

            // Check if the email already exists
            if ($this->owner->emailExists($email)) {
                $_SESSION['error_message'] = "Email already exists. Please choose a different email.";
                header("Location: ../public/createAdmin.php"); // Redirect back to the add admin form
                exit;
            }

            // Check if the phone number is valid
            if (!$this->owner->isValidPhoneNumber($phoneNumber)) {
                $_SESSION['error_message'] = "Phone number must be exactly 12 digits.";
                header("Location: ../public/createAdmin.php"); // Redirect back to the add admin form
                exit;
            }

            // Check if the phone number already exists
            if ($this->owner->phoneNumberExists($phoneNumber)) {
                $_SESSION['error_message'] = "Phone number already exists. Please choose a different phone number.";
                header("Location: ../public/createAdmin.php"); // Redirect back to the add admin form
                exit;
            }

            // Check if the password is valid
            if (!$this->owner->isValidPassword($password)) {
                $_SESSION['error_message'] = "Password must be at least 8 characters long and contain at least one number.";
                header("Location: ../public/createAdmin.php"); // Redirect back to the add admin form
                exit;
            }

            // Add the admin via the Owners model
            if ($this->owner->addAdmin($username, $email, $password, $phoneNumber)) {
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
        header("Location: ../public/createAdmin.php"); // Replace with your actual redirect page
        exit;
    }
}

public function addNormalUser ()
{
    error_log("addNormalUser  called."); // Log entry for debugging

    try {
        // Check if the request is POST and all required data is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['phone_number'])) {
            $username = htmlspecialchars($_POST['username']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $phoneNumber = htmlspecialchars($_POST['phone_number']);

           // Check if the username already exists
           if ($this->owner->usernameExists($username)) {
            // Check if the existing username is of a different type
            $existingUserType = $this->owner->getUserTypeByUsername($username);
            if ($existingUserType === 'user') {
                $_SESSION['error_message'] = "Username already exists for a user. Please choose a different username.";
                header("Location: ../public/adduser.php"); // Redirect back to the add user form
                exit;
            }
        }

            // Check if the email is valid
            if (!$this->owner->isValidEmail($email)) {
                $_SESSION['error_message'] = "Invalid email format. Please enter a valid email.";
                header("Location: ../public/adduser.php"); // Redirect back to the add user form
                exit;
            }

            // Check if the email already exists
            if ($this->owner->emailExists($email)) {
                $_SESSION['error_message'] = "Email already exists. Please choose a different email.";
                header("Location: ../public/adduser.php"); // Redirect back to the add user form
                exit;
            }

            // Check if the phone number is valid
            if (!$this->owner->isValidPhoneNumber($phoneNumber)) {
                $_SESSION['error_message'] = "Phone number must be exactly 12 digits.";
                header("Location: ../public/adduser.php"); // Redirect back to the add user form
                exit;
            }

            // Check if the phone number already exists
            if ($this->owner->phoneNumberExists($phoneNumber)) {
                $_SESSION['error_message'] = "Phone number already exists. Please choose a different phone number.";
                header("Location: ../public/adduser.php"); // Redirect back to the add user form
                exit;
            }

            // Check if the password is valid
            if (!$this->owner->isValidPassword($password)) {
                $_SESSION['error_message'] = "Password must be at least 8 characters long and contain at least one number.";
                header("Location: ../public/adduser.php"); // Redirect back to the add user form
                exit;
            }

            // Add the normal user via the Owners model
            if ($this->owner->addNormalUser ($username, $email, $password, $phoneNumber)) {
                // Redirect with success message
                $_SESSION['success_message'] = "User  added successfully.";
                header("Location: ../public/ManageUsers.php"); // Correct redirect path for adding normal users
                exit;
            } else {
                $_SESSION['error_message'] = "Failed to add user.";
                header("Location: ../public/adduser.php"); // Redirect back to the add user form
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Invalid input data.";
            header("Location: ../public/adduser.php"); // Redirect back to the add user form
            exit;
        }
    } catch (Exception $e) {
        // Log the exception and redirect with a generic error message
        error_log("Error in addNormal:User  " . $e->getMessage());
        $_SESSION['error_message'] = "An unexpected error occurred. Please try again.";
        header("Location: ../public/adduser.php"); // Redirect back to the add user form
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

public function editclient()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['username'], $_POST['email'], $_POST['phone_number'])) {
        $userId = htmlspecialchars($_POST['id']);
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $phoneNumber = htmlspecialchars($_POST['phone_number']);

        // Call the client's editclient method and handle the result
        if ($this->client->editclient($userId, $username, $email, $phoneNumber)) {
            $_SESSION['success_message'] = "Profile updated successfully!";
            header("Location: myaccount.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Failed to update profile.";
            header("Location: myaccount.php");
            exit;
        }
    } else {
        http_response_code(400);
        $_SESSION['error_message'] = "Invalid request.";
        header("Location: myaccount.php");
        exit;
    }
}

public function getUserOrders($userId)
{
    return $this->client->getOrdersByClient($userId);
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
elseif ($action === 'editClient' &&
    isset($_POST['id'], $_POST['username'], $_POST['email'], $_POST['phone_number'])) {
        try {
            error_log("Routing to editclient for ID: " . $_POST['id']);
            $manageuser->editclient();
        } catch (Exception $e) {
            error_log("Error in editclient: " . $e->getMessage());
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
