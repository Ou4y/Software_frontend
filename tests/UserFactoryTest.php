<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../Models/owners.php');
require_once(__DIR__ . '/../Models/UserFactory.php'); // Include UserFactory class

class UserFactoryTest extends TestCase
{
    public function testCreateUserInstance()
    {
        $userFactory = new UserFactory();
        
        // Test that 'user' type returns an instance of the User class
        $userInstance = $userFactory::create('user');
        $this->assertInstanceOf(User::class, $userInstance);
    }

    public function testCreateOwnersInstance()
    {
        $userFactory = new UserFactory();

        // Test that 'owners' type returns an instance of the owners class
        $ownersInstance = $userFactory::create('owners');
        $this->assertInstanceOf(owners::class, $ownersInstance);
    }

    public function testInvalidType()
    {
        $this->expectException(Exception::class); // Expect an exception to be thrown

        // Test that an invalid type throws an exception
        $userFactory = new UserFactory();
        $userFactory::create('invalid_type'); // Invalid type should trigger an exception
    }
}
