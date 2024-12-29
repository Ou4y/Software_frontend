    <?php
    require_once (__DIR__ . '/../Models/DataBase.php');
    require_once(__DIR__ . '/../Models/User.php');

    class client extends User
    {
        private $conn;

        public function __construct()
        {
            $this->conn = Database::getInstance()->getConnection();
            parent::__construct($this->conn);

        }
        public function editclient($userId, $username, $email, $phoneNumber)
    {
        try {
            if (!isset($userId) || !is_numeric($userId)) {
                throw new Exception("Invalid user ID provided.");
            }

            $stmt = $this->conn->prepare("
                UPDATE users
                SET username = :username, email = :email, phone_number = :phone_number
                WHERE id = :userId
            ");

            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone_number', $phoneNumber, PDO::PARAM_STR);

            error_log("SQL Query: " . $stmt->queryString);
            error_log("Parameters: userId=$userId, username=$username, email=$email, phone_number=$phoneNumber");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                error_log("User updated successfully for userId=$userId.");
                return true;
            } else {
                error_log("No rows updated for userId=$userId.");
                return false;
            }
        } catch (Exception $e) {
            error_log("Error in editUser: " . $e->getMessage());
            throw $e;
        }
    }
    public function getOrdersByClient($userId)
{
    try {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id = :userId ORDER BY order_date DESC");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error fetching client orders: " . $e->getMessage());
        return [];
    }
}

    
        
    }
    ?>