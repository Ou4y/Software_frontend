<?php
require_once(__DIR__ . '/../DataBase.php');

class Product {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function addProduct($title, $price, $type, $attributes = []) {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO products (title, price, type) VALUES (?, ?, ?)");
            $stmt->execute([$title, $price, $type]);

            $productId = $this->conn->lastInsertId();

            $attributeStmt = $this->conn->prepare("INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (?, ?, ?)");
            foreach ($attributes as $name => $value) {
                if (!empty($value)) {
                    $attributeStmt->execute([$productId, $name, $value]);
                }
            }

            $this->conn->commit();
            return $productId;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error in addProduct: " . $e->getMessage());
            return false;
        }
    }

    public function getProducts() {
        try {
            $stmt = $this->conn->prepare("
                SELECT p.id AS product_id, p.title, p.price, pa.attribute_name, pa.attribute_value
                FROM products p
                LEFT JOIN product_attributes pa ON p.id = pa.product_id
                ORDER BY p.id, pa.attribute_name
            ");
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    public function deleteProduct($productId) {
        if (!isset($productId) || !is_numeric($productId)) {
            throw new Exception("Invalid product ID provided.");
        }

        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("DELETE FROM product_attributes WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();

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



    public function getProductsByID($productId) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $productId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    
    public function getAttributesByID($productId) {
        $stmt = $this->conn->prepare("SELECT attribute_name, attribute_value FROM product_attributes WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    



    public function getImageByID($productId) {
        $stmt = $this->conn->prepare("SELECT * FROM product_attributes WHERE product_id = :product_id AND attribute_name = 'image1'");
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}
?>
