<?php
require_once(__DIR__ . '/../Models/User.php');
require_once(__DIR__ . '/../DataBase.php');
class owners extends User
{
    private $conn;

    public function __construct($dbConnection)
    {
        parent::__construct($dbConnection);
    
    }
    public function deleteUser($userId)
{
   
    return parent::deleteUser($userId);
}


}
?>
