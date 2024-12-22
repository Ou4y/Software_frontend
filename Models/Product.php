<?php
require_once(__DIR__ . '/../DataBase.php');

class Product {

    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Modified addProduct to accept individual parameters
    public function addProduct($title, $description, $color, $sizes, $quantity, $price, $category, $gender, $discount, $images)
    {
        try {
            // Prepare SQL statement with placeholders
            $stmt = $this->conn->prepare("INSERT INTO products 
                (title, description, available_colors, available_sizes, available_quantity, price, category, type, discount, picture1) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // Bind the data passed individually as parameters
            $stmt->execute([
                $title,
                $description,
                $color,
                $sizes,
                $quantity,
                $price,
                $category,
                $gender,
                $discount,
                $images
            ]);

            return true; // Return true if successful
        } catch (PDOException $e) {
            // Log error and return false if exception is caught
            error_log("Error in addProduct: " . $e->getMessage());
            return false;
        }
    }



    public function getProducts()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM products");
            $stmt->execute();

            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 // Debugging output
        if (empty($products)) {
            error_log("No products found in the database.");
        } else {
            error_log("Products fetched successfully: " . print_r($products, true));
        }
            return $products; // Return the products
        } catch (PDOException $e) {
            error_log("Error in getProducts: " . $e->getMessage());
            return false;
        }
    }
}
?>
