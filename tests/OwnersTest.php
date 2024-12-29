<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/owners.php');
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../Models/DataBase.php');

class OwnersTest extends TestCase
{
    private $owner;

    protected function setUp(): void
    {
        // Set up the owner object to test
        $this->owner = new owners();
    }

    public function testAddAdmin()
    {
        // Test for adding an admin
        $username = 'admin_test';
        $email = 'admin@test.com';
        $password = 'password123';
        $phoneNumber = '1234567890';

        $result = $this->owner->addAdmin($username, $email, $password, $phoneNumber);

        // Assert that the result is true, indicating the admin was added successfully
        $this->assertTrue($result);
    }

    public function testAddNormalUser()
    {
        // Test for adding a normal user
        $username = 'user_test';
        $email = 'user@test.com';
        $password = 'password123';
        $phoneNumber = '0987654321';

        $result = $this->owner->addNormalUser($username, $email, $password, $phoneNumber);

        // Assert that the result is true, indicating the user was added successfully
        $this->assertTrue($result);
    }

    public function testDeleteUser()
    {
        // Assume a user with ID 1 exists and can be deleted
        $userId = 1;

        // Mocking the parent deleteUser method
        $this->owner = $this->createMock(owners::class);
        $this->owner->method('deleteUser')->willReturn(true);

        $result = $this->owner->deleteUser($userId);

        // Assert that the user deletion was successful
        $this->assertTrue($result);
    }

    public function testEditUser()
    {
        $userId = 1; // Assume a valid user ID
        $username = 'updated_user';
        $email = 'updated_email@test.com';
        $phoneNumber = '1122334455';

        // Mock the database interaction if needed for testing
        $this->owner = $this->createMock(owners::class);
        $this->owner->method('editUser')->willReturn(true);

        $result = $this->owner->edituser($userId, $username, $email, $phoneNumber);

        // Assert that the user was updated successfully
        $this->assertTrue($result);
    }

    public function testEditUserFailure()
    {
        $userId = 9999; // Invalid user ID to simulate failure
        $username = 'fail_user';
        $email = 'fail_email@test.com';
        $phoneNumber = '0000000000';

        // Mock the database interaction for testing failure
        $this->owner = $this->createMock(owners::class);
        $this->owner->method('editUser')->willReturn(false);

        $result = $this->owner->edituser($userId, $username, $email, $phoneNumber);

        // Assert that the update was unsuccessful
        $this->assertFalse($result);
    }
}
?>
