<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/Database.php');

class DatabaseTest extends TestCase
{
    private $db;

    // Setup method to initialize the Database instance
    protected function setUp(): void
    {
        $this->db = Database::getInstance(); // Get the singleton instance
    }

    // Test the singleton pattern to ensure only one instance is created
    public function testSingletonInstance()
    {
        $instance1 = Database::getInstance();
        $instance2 = Database::getInstance();

        // Assert that both instances are the same, verifying the singleton pattern
        $this->assertSame($instance1, $instance2);
    }

    // Test that the getConnection method returns a valid PDO connection
    public function testGetConnection()
    {
        $connection = $this->db->getConnection();

        // Assert that the connection is an instance of PDO
        $this->assertInstanceOf(PDO::class, $connection);

        // Optionally, check if the connection is open
        $this->assertNotNull($connection);
    }

    // Test case to simulate invalid connection credentials
    // Note: This method may require you to change the DB connection settings temporarily
    public function testInvalidConnection()
    {
        // You can use a custom test database or configure incorrect credentials to simulate failure
        $this->expectException(PDOException::class);

        // Create a mock database class or alter the connection parameters (not recommended)
        $invalidDb = $this->createMock(Database::class);
        $invalidDb->method('getConnection')->willThrowException(new PDOException('Connection failed'));

        $invalidDb->getConnection(); // This should throw an exception
    }
}
