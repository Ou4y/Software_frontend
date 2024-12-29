<?php
require_once (__DIR__ . '/../Models/DataBase.php');


$user = new User();
class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
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
    error_log("Parent deleteUser called with userId: " . var_export($userId, true));
    if (!isset($userId) || !is_numeric($userId)) {
        throw new Exception("Invalid user ID provided."); 
    }

    try {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return true; 
    } catch (PDOException $e) {
        error_log("Error in deleteUser: " . $e->getMessage());
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
public function usernameExists($username)
{
    try {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        return $count > 0; // Returns true if the username exists, false otherwise
    } catch (PDOException $e) {
        error_log("Error in usernameExists: " . $e->getMessage());
        return false; // Return false in case of an error
    }
}
public function emailExists($email)
{
    try {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        return $count > 0; // Returns true if the email exists, false otherwise
    } catch (PDOException $e) {
        error_log("Error in emailExists: " . $e->getMessage());
        return false; // Return false in case of an error
    }
}

public function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@') !== false;
}
public function phoneNumberExists($phoneNumber)
{
    try {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE Phone_Number = ?");
        $stmt->execute([$phoneNumber]);
        $count = $stmt->fetchColumn();

        return $count > 0; // Returns true if the phone number exists, false otherwise
    } catch (PDOException $e) {
        error_log("Error in phoneNumberExists: " . $e->getMessage());
        return false; // Return false in case of an error
    }
}
public function isValidPhoneNumber($phoneNumber)
{
    return preg_match('/^\d{11}$/', $phoneNumber); // Check if the phone number is exactly 11 digits
}
public function isValidPassword($password)
{
    // Check if the password is at least 8 characters long and contains at least one number
    return preg_match('/^(?=.*\d).{8,}$/', $password);
}
public function getUserTypeByUsername($username)
{
    try {
        $stmt = $this->conn->prepare("SELECT user_type FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ? $user['user_type'] : null; // Return the user type or null if not found
    } catch (PDOException $e) {
        error_log("Error in getUser TypeByUsername: " . $e->getMessage());
        return null; // Return null in case of an error
    }
}
}
?>
