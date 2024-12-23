<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../DataBase.php');

class manageuser
{
    private $user;

    public function __construct()
    {
        // Create a database connection
        $dbConnection = (new Database())->getConnection();

        // Now pass the connection to the User class constructor
        $this->user = new User($dbConnection);
    }
    public function deleteUser()
    {
        header('Content-Type: application/json'); // Ensure JSON response
        try {
            // Check if the request is POST and an ID is provided
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                $userId = htmlspecialchars($_POST['id']); // Sanitize the input
                if ($this->user->deleteUser($userId)) {
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
    }

    public function getAllUsers()
    {
        return $this->user->getAllUsers();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manageUser = new ManageUser();
    $manageUser->deleteUser();
    exit; 
}
    ?>