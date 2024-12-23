<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../DataBase.php');
class owners extends User
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }
    public function deleteUser($userId)
{
    if (!isset($userId) || !is_numeric($userId)) {
        throw new Exception("Invalid user ID provided."); 
    }

    try {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return true; 
    } catch (PDOException $e) {
        throw new Exception("Database error: " . $e->getMessage()); 
    }
    return parent::deleteUser($userId);
}


}
?>
