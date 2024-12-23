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
    header('Content-Type: application/json'); // Ensure JSON response
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $userId = htmlspecialchars($_POST['id']); // Sanitize the input

            // Call deleteClient method in the Owners class
            if ($this->owner->deleteUser($userId)) {
                echo json_encode(['success' => true, 'message' => 'User deleted successfully.']);
                exit; // Stop further processing
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            exit;
        }
    } catch (Exception $e) {
        http_response_code(500);
        error_log("Error in deleteUser: " . $e->getMessage()); // Log the error
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        exit;
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