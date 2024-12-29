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
        $userId = 1; // Assuming this user exists in your test database
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
        $this->assertNotEmpty($orders); // Ensures there are orders
    }

    // Test the getOrdersByClient method for a client with no orders
   public function testGetOrdersByClientNoOrders()
{
    $client = new client();

    // Use a user ID that you know has no orders in the database
    $userId = 999;  // You should ensure that this ID has no orders in the database

    try {
        // Call the method that should throw a PDOException
        $client->getOrdersByClient($userId);

        // If we reach here, the exception was not thrown
        $this->fail("Expected PDOException was not thrown");
    } catch (PDOException $e) {
        // Ensure that the exception message is correct
        $this->assertEquals("No orders found for userId: 999", $e->getMessage());
    }
}


    // Test the getOrdersByClient method for invalid userId
    public function testGetOrdersByClientInvalidUserId()
    {
        $userId = 'invalid'; // Invalid userId

        // Expect an exception due to invalid userId
        $this->expectException(PDOException::class);

        // Call the getOrdersByClient method
        $this->client->getOrdersByClient($userId);
    }
}
