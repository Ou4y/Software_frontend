<?php
require_once(__DIR__ . '/../DataBase.php');

class ConfirmOrderModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Start a transaction
    public function beginTransaction() {
        $this->db->beginTransaction(); // Corrected method name
    }

    // Commit the transaction
    public function commitTransaction() {
        $this->db->commit(); // Corrected method name
    }

    // Rollback the transaction
    public function rollbackTransaction() {
        $this->db->rollback(); // Corrected method name
    }

    // Create an order
    public function createOrder($userId, $name, $email, $address, $city, $zipCode, $orderDate, $totalAmount) {
        $query = "INSERT INTO orders (user_id, name, email, address, city, Zipcode, order_date, total_amount) 
                  VALUES (:user_id, :name, :email, :address, :city, :zip_code, :order_date, :total_amount)";
        
        $stmt = $this->db->prepare($query);

        // Bind parameters using bindParam()
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':zip_code', $zipCode, PDO::PARAM_STR);
        $stmt->bindParam(':order_date', $orderDate, PDO::PARAM_STR);
        $stmt->bindParam(':total_amount', $totalAmount, PDO::PARAM_STR);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    // Create an order item
    public function createOrderItem($orderId, $productId, $quantity, $price) {
        $query = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                  VALUES (:order_id, :product_id, :quantity, :price)";
        
        $stmt = $this->db->prepare($query);

        // Bind parameters using bindParam()
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);

        $stmt->execute();
    }
}
?>





