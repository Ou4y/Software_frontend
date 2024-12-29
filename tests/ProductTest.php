<?php
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../Models/Product.php');
require_once(__DIR__ . '/../Models/DataBase.php'); // Adjust the path as needed

class ProductTest extends TestCase {
    private $product;

    protected function setUp(): void {
        // Initialize the Product class for testing
        $this->product = new Product();
    }

    public function testAddProduct() {
        $title = "Test Product";
        $price = 99.99;
        $type = "Test Type";
        $attributes = [
            'color' => 'red',
            'size' => 'M',
        ];

        $productId = $this->product->addProduct($title, $price, $type, $attributes);

        // Assert product is added and ID is returned
        $this->assertIsNumeric($productId);

        // Verify product exists in the database
        $product = $this->product->getProductsByID($productId);
        $this->assertNotEmpty($product);
        $this->assertEquals($title, $product['title']);
        $this->assertEquals($price, $product['price']);
        $this->assertEquals($type, $product['type']);

        // Verify attributes
        $attributesFromDB = $this->product->getAttributesByID($productId);
        $this->assertCount(2, $attributesFromDB);
        foreach ($attributesFromDB as $attr) {
            $this->assertEquals($attributes[$attr['attribute_name']], $attr['attribute_value']);
        }
    }

    public function testGetProducts() {
        $products = $this->product->getProducts();

        // Assert that the result is an array
        $this->assertIsArray($products);

        // Verify the structure of the returned data
        foreach ($products as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('title', $product);
            $this->assertArrayHasKey('price', $product);
            $this->assertArrayHasKey('attributes', $product);
        }
    }

    public function testDeleteProduct() {
        // First, add a product to delete
        $productId = $this->product->addProduct("To be deleted", 10.00, "Delete Test", ['test_attr' => 'test_value']);

        // Delete the product
        $result = $this->product->deleteProduct($productId);

        // Assert deletion is successful
        $this->assertTrue($result);

        // Verify the product no longer exists
        $deletedProduct = $this->product->getProductsByID($productId);
        $this->assertFalse($deletedProduct);

        // Verify attributes are also deleted
        $attributes = $this->product->getAttributesByID($productId);
        $this->assertEmpty($attributes);
    }

    public function testGetProductsByType() {
        $type = "Test Type";

        // Add a product with the given type
        $this->product->addProduct("Typed Product", 20.00, $type);

        // Fetch products by type
        $products = $this->product->getProductsByType($type);

        // Assert the returned data contains products of the given type
        $this->assertIsArray($products);
        foreach ($products as $product) {
            $this->assertEquals($type, $product['type']);
        }
    }

    public function testGetImageByID() {
        // Add a product with an image attribute
        $productId = $this->product->addProduct("Image Test", 15.00, "Image Type", ['image1' => 'image.jpg']);

        // Fetch the image by product ID
        $image = $this->product->getImageByID($productId);

        // Assert the image is returned correctly
        $this->assertNotEmpty($image);
        $this->assertEquals('image.jpg', $image['attribute_value']);
    }
}
