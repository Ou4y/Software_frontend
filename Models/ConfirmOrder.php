<?php
// OrderModel.php

class ConfirmOrder
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createOrder($userId, $paymentType, $totalAmount)
    {
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, payment_type, total_amount, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("isd", $userId, $paymentType, $totalAmount);
        return $stmt->execute();
    }
    

    public function addOrderItem($orderId, $productId, $quantity, $price)
    {
        $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $orderId, $productId, $quantity, $price);
        return $stmt->execute();
    }
}
?>
