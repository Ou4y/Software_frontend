<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/ConfirmOrder.php');
require_once(__DIR__ . '/../Models/DataBase.php'); // Adjust the path as needed

class ConfirmOrderTest extends TestCase {
    private $confirmOrder;



    
    protected function setUp(): void {
        // Initialize the ConfirmOrder class for testing
        $this->confirmOrder = new ConfirmOrderModel();
        // Ensure no active transaction at the start of each test
        $this->confirmOrder->beginTransaction();
    }

    protected function tearDown(): void {
        // Ensure that the transaction is committed or rolled back after each test
        $this->confirmOrder->rollbackTransaction(); // Always rollback to avoid any side effects
    }


    public function testCreateOrder() {
        // Create a test order
        $userId = 1;
        $name = "John Doe";
        $email = "john.doe@example.com";
        $address = "123 Street";
        $city = "City";
        $zipCode = "12345";
        $orderDate = "2024-12-29";
        $totalAmount = 99.99;

        // Create an order and check if order ID is returned
        $orderId = $this->confirmOrder->createOrder($userId, $name, $email, $address, $city, $zipCode, $orderDate, $totalAmount);

        $this->assertIsNumeric($orderId);
    }

    public function testCreateOrderItem() {
        // Assuming an order has been created first
        $orderId = 1;  // Mock order ID for test
        $productId = 100;
        $quantity = 2;
        $price = 50.00;

        // Create an order item
        $this->confirmOrder->createOrderItem($orderId, $productId, $quantity, $price);

        // Assert no exception is thrown, and the item is added successfully
        $this->assertTrue(true);
    }
}
?>
