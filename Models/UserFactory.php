<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../Models/owners.php');
require_once(__DIR__ . '/../Models/DataBase.php');

class UserFactory
{
    public static function create($type)
{
    $dbConnection = Database::getInstance()->getConnection();

    switch (strtolower($type)) {
        case 'owners':
            return new owners($dbConnection);
        case 'user':
            return new User($dbConnection);
        default:
            throw new Exception("Invalid user type provided.");
    }
}

}
?>
