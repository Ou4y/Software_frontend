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
    public function deleteUser($userId){

    return parent::deleteUser($userId);
}

public function addadmin($username, $email, $password, $phoneNumber)
{
    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (Username, email, password, Phone_Number,user_type) VALUES (?, ?, ?, ?, 'user')");
        $stmt->execute([$username, $email, $hashedPassword, $phoneNumber]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
    public function adduser($username, $email, $password, $phone_number)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, phone_number, user_type) VALUES (?, ?, ?, ?, 'user')");
            $stmt->execute([$username, $email, $hashedPassword, $phone_number]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}
?>
