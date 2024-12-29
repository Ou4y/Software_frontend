<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/AdminDashboard.php');
require_once(__DIR__ . '/../Models/DataBase.php'); // Adjust the path as needed

class AdminDashboardTest extends TestCase {
    private $adminDashboard;

    protected function setUp(): void {
        // Initialize the AdminDashboard class for testing
        $this->adminDashboard = new AdminDashboard();
    }

    public function testGetTotalProducts() {
        // Call the method to get the total products count
        $totalProducts = $this->adminDashboard->getTotalProducts();

        // Assert the result is a numeric value
        $this->assertIsNumeric($totalProducts);

        // Optional: You can check if the value is >= 0 since total products cannot be negative
        $this->assertGreaterThanOrEqual(0, $totalProducts);
    }

    public function testGetTotalUsers() {
        // Call the method to get the total users count
        $totalUsers = $this->adminDashboard->getTotalUsers();

        // Assert the result is a numeric value
        $this->assertIsNumeric($totalUsers);

        // Optional: You can check if the value is >= 0 since total users cannot be negative
        $this->assertGreaterThanOrEqual(0, $totalUsers);
    }

    public function testGetTotalOrders() {
        // Call the method to get the total orders count
        $totalOrders = $this->adminDashboard->getTotalOrders();

        // Assert the result is a numeric value
        $this->assertIsNumeric($totalOrders);

        // Optional: You can check if the value is >= 0 since total orders cannot be negative
        $this->assertGreaterThanOrEqual(0, $totalOrders);
    }

    public function testGetOrders() {
        // Call the method to get the orders data
        $orders = $this->adminDashboard->getOrders();

        // Assert that the result is an array
        $this->assertIsArray($orders);

        // Verify the structure of the returned data
        foreach ($orders as $order) {
            $this->assertArrayHasKey('username', $order);
            $this->assertArrayHasKey('email', $order);
            $this->assertArrayHasKey('total_amount', $order);
            $this->assertArrayHasKey('order_date', $order);
            $this->assertArrayHasKey('status', $order);
        }
    }
}
?>
