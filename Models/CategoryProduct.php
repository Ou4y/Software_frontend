<?php
require_once(__DIR__ . '/../Models/Product.php');
require_once(__DIR__ . '/../DataBase.php');

class CategoryProduct extends Product {
    private $conn;

    public function __construct($dbConnection)
    {
        parent::__construct($dbConnection);  // Call the parent class constructor to initialize the $conn
        $this->conn = $dbConnection;
    }

    public function getMenProducts() {
        return $this->getProductsByType('MEN');
    }

    public function getWomenProducts() {
        return $this->getProductsByType('WOMEN');
    }

    public function getSportswearProducts() {
        return $this->getProductsByType('SPORTSWEAR');  // Fixed typo here (was 'SPOERTSWEAR')
    }

    public function getUnisexProducts() {
        return $this->getProductsByType('UNISEX');
    }

    public function getSaleProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE discount > 0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
}

?>