<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../DataBase.php');

$db = new Database();
$conn = $db->getConnection();
$owner = new owners($conn);

class owners extends User
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;

        parent::__construct($dbConnection);
    
    }
    public function deleteUser($userId) {
        try {
            error_log("deleteUser called in owners with ID: $userId"); 
            return parent::deleteUser($userId); 
        } catch (Exception $e) {
            error_log("Error in owners deleteUser: " . $e->getMessage());
            throw $e;
        }
    }

    public function addAdmin($username, $email, $password, $phoneNumber)
    {
        return parent::addUser($username, $email, $password, $phoneNumber, 'admin');
    }
    
    public function addNormalUser($username, $email, $password, $phoneNumber)
    {
        return parent::addUser($username, $email, $password, $phoneNumber, 'user');
    }
    
    public function edituser($userId, $username, $email, $phoneNumber)
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
        error_log("Parameters: userId=$userId, username=$username, email=$email, phoneNumber=$phoneNumber");

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



}
?>
