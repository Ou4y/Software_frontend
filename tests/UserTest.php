<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../Models/DataBase.php');

class UserTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        // Create the User object
        $this->user = new User();
    }

    public function testSignUp()
    {
        $username = 'test_user';
        $email = 'testuser@example.com';
        $password = 'password123';
        $phoneNumber = '1234567890';

        $result = $this->user->signUp($username, $email, $password, $phoneNumber);

        // Assert that the user was successfully added
        $this->assertTrue($result);
    }

    public function testSignInSuccess()
    {
        $email = 'testuser@example.com';
        $password = 'password123';

        // Assuming that a user exists with this email and password
        $result = $this->user->signIn($email, $password);

        // Assert that the result is not null, indicating successful sign-in
        $this->assertNotNull($result);
    }

    public function testSignInFailure()
    {
        $email = 'nonexistentuser@example.com';
        $password = 'wrongpassword';

        $result = $this->user->signIn($email, $password);

        // Assert that the result is null, indicating failed sign-in
        $this->assertNull($result);
    }

    public function testDeleteUser()
    {
        $userId = 1; // Assuming user with ID 1 exists

        // Mocking the deleteUser method to return true
        $result = $this->user->deleteUser($userId);

        // Assert that the user was successfully deleted
        $this->assertTrue($result);
    }

    public function testDeleteUserFailure()
    {
        $userId = 'invalid_id'; // Invalid user ID to trigger failure

        // Expecting an exception
        $this->expectException(Exception::class);

        $this->user->deleteUser($userId);
    }

    public function testGetAllUsers()
    {
        // Fetch all users
        $result = $this->user->getAllUsers();

        // Assert that the result is an array
        $this->assertIsArray($result);
    }

    public function testGetAdmin()
    {
        // Fetch all admins
        $result = $this->user->getadmin();

        // Assert that the result is an array
        $this->assertIsArray($result);
    }

    public function testGetUserByIdSuccess()
    {
        $userId = 1; // Assuming user with ID 1 exists

        $result = $this->user->getUserById($userId);

        // Assert that the result is an array, indicating the user was found
        $this->assertIsArray($result);
    }

    public function testGetUserByIdFailure()
    {
        $userId = 9999; // Non-existing user ID to trigger failure

        $result = $this->user->getUserById($userId);

        // Assert that the result is null, indicating the user was not found
        $this->assertNull($result);
    }

    public function testAddUser()
    {
        $username = 'new_user';
        $email = 'newuser@example.com';
        $password = 'newpassword123';
        $phoneNumber = '9876543210';
        $userType = 'user';

        $result = $this->user->addUser($username, $email, $password, $phoneNumber, $userType);

        // Assert that the user was successfully added
        $this->assertTrue($result);
    }
}
?>
