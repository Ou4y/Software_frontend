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

    // Fetch and display sale products
    public function getSaleProducts() {
        return $this->categoryProductModel->getSaleProducts();
    }

    // Fetch and display latest products
    public function getLatestProducts() {
        return $this->categoryProductModel->getLatestProducts();
    }
}
?>
