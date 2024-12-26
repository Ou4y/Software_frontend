<?php
require_once(__DIR__ . '/../DataBase.php');

class Product {

    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Add a new product with attributes
    public function addProduct($title, $price,$type, $attributes = [])
    {
        try {
            $this->conn->beginTransaction();

            // Insert basic product details into the `products` table
            $stmt = $this->conn->prepare("INSERT INTO products (title, price,type) VALUES (?, ?,?)");
            $stmt->execute([$title, $price,$type]);

            // Get the newly inserted product ID
            $productId = $this->conn->lastInsertId();

            // Insert attributes into the `product_attributes` table
            $attributeStmt = $this->conn->prepare("INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (?, ?, ?)");
            foreach ($attributes as $name => $value) {
                if (!empty($value)) { // Skip null or empty values
                    $attributeStmt->execute([$productId, $name, $value]);
                }
            }

            $this->conn->commit();
            return $productId; // Return the ID of the newly created product
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error in addProduct: " . $e->getMessage());
            return false;
        }
    }

    // Fetch all products with their attributes
    public function getProducts()
    {
        try {
            // Query to fetch products and their attributes
            $stmt = $this->conn->prepare("
                SELECT p.id AS product_id, p.title, p.price, pa.attribute_name, pa.attribute_value
                FROM products p
                LEFT JOIN product_attributes pa ON p.id = pa.product_id
                ORDER BY p.id, pa.attribute_name
            ");
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Organize results into structured products
            $products = [];
            foreach ($results as $row) {
                $productId = $row['product_id'];
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'id' => $productId,
                        'title' => $row['title'],
                        'price' => $row['price'],
                        'attributes' => [],
                    ];
                }
                if (!empty($row['attribute_name'])) {
                    $products[$productId]['attributes'][$row['attribute_name']] = $row['attribute_value'];
                }
            }

            return array_values($products);
        } catch (PDOException $e) {
            error_log("Error in getProducts: " . $e->getMessage());
            return false;
        }
    }

    // Delete a product and its attributes
    public function deleteProduct($productId)
    {
        if (!isset($productId) || !is_numeric($productId)) {
            throw new Exception("Invalid product ID provided.");
        }

        try {
            $this->conn->beginTransaction();

            // Delete attributes from product_attributes table
            $stmt = $this->conn->prepare("DELETE FROM product_attributes WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            // Delete product from products table
            $stmt = $this->conn->prepare("DELETE FROM products WHERE id = :product_id");
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getProductsByType($type) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE type = :type");
        $stmt->bindParam(':type', $type);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>