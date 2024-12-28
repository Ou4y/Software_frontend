<?php
require_once (__DIR__ . '/../Models/DataBase.php');

class client extends User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }
 
    
}
?>