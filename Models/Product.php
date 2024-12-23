<?php
require_once(__DIR__ . '/../DataBase.php');

class Product {

    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Modified addProduct to accept individual parameters
    public function addProduct(
        $title,
        $description,
        $color,
        $size_s,
        $size_m,
        $size_l,
        $price,
        $category,
        $gender,
        $discount,
        $picture1,
        $picture2,
        $picture3
    ) {
        try {
            // Prepare SQL statement with placeholders
            $stmt = $this->conn->prepare("INSERT INTO products 
                (title, description, available_colors, Quantity_S, Quantity_M, Quantity_L, price, category, type, discount, picture1, picture2, picture3) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
            // Bind the data passed individually as parameters
            $stmt->execute([
                $title,
                $description,
                $color,
                $size_s,
                $size_m,
                $size_l,
                $price,
                $category,
                $gender,
                $discount,
                $picture1,
                $picture2,
                $picture3
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

    

    public function deleteproduct($productid)
{
    if (!isset($productid) || !is_numeric($productid)) {
        throw new Exception("Invalid product ID provided."); 
    }

    try {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = :productid");
        $stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
        $stmt->execute();
        return true; 
    } catch (PDOException $e) {
        throw new Exception("Database error: " . $e->getMessage()); 
    }
}

}
?>
