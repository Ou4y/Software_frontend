<?php
require_once(__DIR__ . '/../Models/Product.php');
require_once (__DIR__ . '/../Models/DataBase.php');

class CategoryProduct extends Product {
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();

        // Call the parent class constructor and pass the Singleton connection
        parent::__construct($this->conn);
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



    public function getRandomProducts($limit = 3) {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY RAND() LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function getProductsByID($productId) {
        return parent::getProductsByID($productId);
    }

    public function getAttributesByID($productId) {
        return parent::getAttributesByID($productId);
    }


    public function getImageByID($productId) {
        return parent::getImageByID($productId);
    }
}

?>