<?php
require_once(__DIR__ . '/../Models/Product.php');
require_once(__DIR__ . '/../DataBase.php');

class CategoryProduct extends Product {
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Method to fetch men's products
    public function getMenProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE type = 'men'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch women's products
    public function getWomenProducts() {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("
                SELECT p.* 
                FROM products p
                JOIN product_attributes pa ON p.id = pa.product_id
                WHERE pa.gender = 'female'
            ");
    
            // Execute the statement
            $stmt->execute();
    
            // Fetch all the results as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle any errors (optional logging can be added here)
            echo "Error: " . $e->getMessage();
            return false; // or handle the error in an appropriate way
        }
    }
    

    // Method to fetch sportswear products
    public function getSportswearProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE type = 'sportswear'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch sale products
    public function getSaleProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE discount > 0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch latest products
    public function getLatestProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 10");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
