<?php
require_once(__DIR__ . '/../DataBase.php');

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
}
?>
