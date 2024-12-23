<?php
require_once(__DIR__ . '/../DataBase.php');

class client extends User
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }
 
    
}
?>