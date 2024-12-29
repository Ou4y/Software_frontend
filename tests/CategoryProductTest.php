<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/CategoryProduct.php');
require_once(__DIR__ . '/../Models/DataBase.php'); // Adjust the path as needed

class CategoryProductTest extends TestCase {
    private $categoryProduct;

    protected function setUp(): void {
        // Initialize the CategoryProduct class for testing
        $this->categoryProduct = new CategoryProduct();
    }

    public function testGetMenProducts() {
        // Call the method to get men's products
        $products = $this->categoryProduct->getMenProducts();

        // Assert the result is an array
        $this->assertIsArray($products);

        // Verify the structure and the category of products
        foreach ($products as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('title', $product);
            $this->assertArrayHasKey('type', $product);
            $this->assertEquals('MEN', $product['type']);
        }
    }

    public function testGetWomenProducts() {
        // Call the method to get women's products
        $products = $this->categoryProduct->getWomenProducts();

        // Assert the result is an array
        $this->assertIsArray($products);

        // Verify the structure and the category of products
        foreach ($products as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('title', $product);
            $this->assertArrayHasKey('type', $product);
            $this->assertEquals('WOMEN', $product['type']);
        }
    }

    public function testGetSportswearProducts() {
        // Call the method to get sportswear products
        $products = $this->categoryProduct->getSportswearProducts();

        // Assert the result is an array
        $this->assertIsArray($products);

        // Verify the structure and the category of products
        foreach ($products as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('title', $product);
            $this->assertArrayHasKey('type', $product);
            $this->assertEquals('SPORTSWEAR', $product['type']);
        }
    }

    public function testGetUnisexProducts() {
        // Call the method to get unisex products
        $products = $this->categoryProduct->getUnisexProducts();

        // Assert the result is an array
        $this->assertIsArray($products);

        // Verify the structure and the category of products
        foreach ($products as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('title', $product);
            $this->assertArrayHasKey('type', $product);
            $this->assertEquals('UNISEX', $product['type']);
        }
    }

    public function testGetRandomProducts() {
        // Call the method to get random products with a limit of 3
        $products = $this->categoryProduct->getRandomProducts(3);

        // Assert the result is an array
        $this->assertIsArray($products);

        // Assert that the number of products returned is 3
        $this->assertCount(3, $products);
    }


    public function testGetLatestProducts() {
        $products = $this->categoryProduct->getLatestProducts();
    
        // Assert the result is an array
        $this->assertIsArray($products);
    
        // Assert that the number of products returned is 3
        $this->assertCount(3, $products);
    
        // Assert that the product IDs are in descending order
        $ids = array_column($products, 'id');
    
        // Ensure that the array of IDs is in descending order
        for ($i = 0; $i < count($ids) - 1; $i++) {
            $this->assertGreaterThanOrEqual($ids[$i + 1], $ids[$i]);
        }
    }
    
    
    

    public function testGetProductsByID() {
        // Add a product first
        $productId = $this->categoryProduct->addProduct("Test Product", 99.99, "MEN", ['color' => 'red']);

        // Call the method to get the product by ID
        $product = $this->categoryProduct->getProductsByID($productId);

        // Assert that the product is returned
        $this->assertNotEmpty($product);
        $this->assertEquals($productId, $product['id']);
    }

    public function testGetAttributesByID() {
        // Add a product first
        $productId = $this->categoryProduct->addProduct("Test Product", 99.99, "MEN", ['color' => 'red']);

        // Call the method to get attributes by product ID
        $attributes = $this->categoryProduct->getAttributesByID($productId);

        // Assert that the attributes are returned and are not empty
        $this->assertIsArray($attributes);
        $this->assertNotEmpty($attributes);
    }




    //M4 Ht4t8l fe el test 3ala 4an el image 48ala btare2a mo5tlfa 4wia

    // public function testGetImageByID() {
    //     // Add a product with an image attribute
    //     $productId = $this->categoryProduct->addProduct("Test Image Product", 49.99, "MEN", ['image' => 'image.jpg']);


    //     // Call the method to get the image by product ID
    //     $image = $this->categoryProduct->getImageByID($productId);

    //     // Assert that the image is returned correctly
    //     $this->assertNotEmpty($image);
    //     $this->assertEquals('image.jpg', $image['attribute_value']);
    // }
    
}
?>
