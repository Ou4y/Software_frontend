<?php
require_once(__DIR__ . '/../DataBase.php');
$db = new Database();
$conn = $db->getConnection();

$user = new User($conn);
class User
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function signUp($username, $email, $password, $phoneNumber)
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

    public function signIn($email, $password)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return null;
        } catch (PDOException $e) {
            return null;
        }
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
}




    public function getAllUsers() {
        $sql = "SELECT id, username, email, phone_number FROM users where user_type='user'";
        $result = $this->conn->query($sql);
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function getadmin() {
        $sql = "SELECT id, username, email, phone_number FROM users where user_type='admin'";
        $result = $this->conn->query($sql);
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUserById($userId)
{
    try {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        }
        return null;
    } catch (PDOException $e) {
        error_log("Error in getUserById: " . $e->getMessage());
        return null;
    }
}

    

    public function addUser($username, $email, $password, $phoneNumber, $userType)
{
    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, phone_number, user_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword, $phoneNumber, $userType]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

    



    
}


?>
