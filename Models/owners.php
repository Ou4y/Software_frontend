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
            error_log("deleteUser called in owners with ID: $userId"); // Debug log
            return parent::deleteUser($userId); // Call parent class
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
    

}
?>
