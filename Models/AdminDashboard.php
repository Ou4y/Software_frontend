<?php
require_once(__DIR__ . '/../DataBase.php');
class AdminDashboard {

    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Get total products count
    public function getTotalProducts() {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS total_products FROM products");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_products']; 
        } catch (PDOException $e) {
            error_log("Error in getTotalProducts: " . $e->getMessage());
            return false;
        }
    }

    // Get total users count
    public function getTotalUsers() {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS total_users FROM users where user_type='user'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_users'];
        } catch (PDOException $e) {
            error_log("Error in getTotalUsers: " . $e->getMessage());
            return false;
        }
    }

    // Get total orders count
    public function getTotalOrders() {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(*) AS total_orders FROM orders ");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_orders'];
        } catch (PDOException $e) {
            error_log("Error in getTotalOrders: " . $e->getMessage());
            return false;
        }
    }

    // Get the orders data
    public function getOrders() {
        try {
            $stmt = $this->conn->prepare("SELECT u.username, u.email, o.total_amount, o.order_date ,o.status
                                          FROM orders o
                                          JOIN users u ON o.user_id = u.id");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getOrders: " . $e->getMessage());
            return false;
        }
    }
}

?>
