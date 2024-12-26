<?php
require_once(__DIR__ . '/../Models/CategoryProduct.php');
require_once(__DIR__ . '/../DataBase.php');

class CategoryProductController {
    private $categoryProductModel;

    public function __construct()
    {
        // Create a database connection
        $dbConnection = (new Database())->getConnection();

        // Initialize the CategoryProduct model
        $this->categoryProductModel = new CategoryProduct($dbConnection);
    }

    // Fetch and display men's products
    public function getMenProducts() {
        return $this->categoryProductModel->getMenProducts();
    }

    // Fetch and display women's products
    public function getWomenProducts() {
        return $this->categoryProductModel->getWomenProducts();
    }

    // Fetch and display sportswear products
    public function getSportswearProducts() {
        return $this->categoryProductModel->getSportswearProducts();
    }

    

    public function getUnisexProducts() {
        return $this->categoryProductModel->getUnisexProducts();
    }

    public function getRandomProducts($limit = 3) {
        return $this->categoryProductModel->getRandomProducts($limit);
    }


    // Fetch and display sale products
    public function getSaleProducts() {
        return $this->categoryProductModel->getSaleProducts();
    }

    // Fetch and display latest products
    public function getLatestProducts() {
        return $this->categoryProductModel->getLatestProducts();
         foreach ($products as &$product) {
            $imageQuery = $this->categoryProductModel->conn->prepare(
                "SELECT value FROM product_attributes WHERE attribute_name = 'image1' AND product_id = :product_id LIMIT 1"
            );
            $imageQuery->bindParam(':product_id', $product['id']);
            $imageQuery->execute();
            $image = $imageQuery->fetchColumn();
            $product['image'] = $image ? $image : 'default.png'; // Add the image path to the product
        }

        return $products;
    }


    public function getProductById($productId) {
        return $this->categoryProductModel->getProductsByID($productId);

    }
}
?>
