<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/client.php');
require_once(__DIR__ . '/../Models/DataBase.php'); // Include Database and other dependencies

class ClientTest extends TestCase
{
    private $client;

    // Setup method to initialize client instance before each test
    protected function setUp(): void
    {
        $this->client = new client();
    }

    // Test the editclient method for success (valid data)
    public function testEditClientSuccess()
    {
        $userId = 2; // Assuming this user exists in your test database
        $username = 'Updated User';
        $email = 'updateduser@example.com';
        $phoneNumber = '1234567890';

        // Call the editclient method
        $result = $this->client->editclient($userId, $username, $email, $phoneNumber);

        // Assert that the result is true indicating a successful update
        $this->assertTrue($result);
    }

    // Test the editclient method with invalid userId (non-numeric)
    public function testEditClientInvalidUserId()
    {
        $userId = 'invalid'; // Invalid userId, should throw an exception
        $username = 'Updated User';
        $email = 'updateduser@example.com';
        $phoneNumber = '1234567890';

        // Expect an exception due to invalid userId
        $this->expectException(Exception::class);

        // Call the editclient method
        $this->client->editclient($userId, $username, $email, $phoneNumber);
    }

    // Test the editclient method when no changes are made (e.g., same data provided)
    public function testEditClientNoChanges()
    {
        $userId = 1; // Assuming this user exists in your test database
        $username = 'Existing User'; // Same username as before
        $email = 'existinguser@example.com'; // Same email as before
        $phoneNumber = '9876543210'; // Same phone number as before

        // Call the editclient method
        $result = $this->client->editclient($userId, $username, $email, $phoneNumber);

        // Assert that the result is false (no rows updated)
        $this->assertFalse($result);
    }

    // Test the getOrdersByClient method for a client with orders
    public function testGetOrdersByClientWithOrders()
    {
        $userId = 1; // Assuming this user has orders in the test database

        // Call the getOrdersByClient method
        $orders = $this->client->getOrdersByClient($userId);

        // Assert that orders are returned and is an array
        $this->assertIsArray($orders);
        
    }

    // Test the getOrdersByClient method for a client with no orders
    public function testGetOrdersByClientNoOrders()
    {
        $client = new Client();
    
        // Use a user ID that you know has no orders in the database
        $userId = 7;  // Ensure this user ID has no orders in your database
    
        // Mock the database or ensure there's no data for this user
        // Assuming your method checks for orders and throws an exception if no orders exist for the user
        try {
            // Call the method to fetch orders for the client
            $orders = $client->getOrdersByClient($userId);
    
            // If no exception was thrown, check if the orders array is empty or null
            $this->assertEmpty($orders, "Expected no orders to be found, but some were returned.");
        } catch (PDOException $e) {
            // If an exception was thrown, check if it's the expected one
            $this->assertEquals("No orders found for userId: $userId", $e->getMessage());
        }
    }
    


    public function testGetOrdersByClientInvalidUserId()
{
    $invalidUserId = 999; // Invalid userId

    // Call the getOrdersByClient method
    $orders = $this->client->getOrdersByClient($invalidUserId);

    // Expect the result to be an empty array
    $this->assertEmpty($orders, "Expected no orders for invalid userId, but got some results.");
}

    
    
}
