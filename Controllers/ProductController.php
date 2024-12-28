<?php
require_once(__DIR__ . '/../Models/Product.php');
require_once(__DIR__ . '/../DataBase.php');

class ProductController
{
    private $productModel;

    public function __construct()
    {
        // Create a database connection
        $dbConnection = (new Database())->getConnection();

        // Initialize the Product model
        $this->productModel = new Product($dbConnection);
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $formType = isset($_POST['form_type']) ? htmlspecialchars($_POST['form_type']) : '';

            if ($formType === 'addProductForm') {
                $this->addProduct();
            }
        }
    }

    public function addProduct()
    {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $color = trim($_POST['color']);
        $sizeS = intval($_POST['size_s']);
        $sizeM = intval($_POST['size_m']);
        $sizeL = intval($_POST['size_l']);
        $price = floatval($_POST['price']);
        $category = trim($_POST['category']);
        $type = trim($_POST['type']);
     

        $uploadedFiles = $this->uploadFiles();
        $image1 = $uploadedFiles[0] ?? null;
        $image2 = $uploadedFiles[1] ?? null;
        $image3 = $uploadedFiles[2] ?? null;

        $attributes = [
            'description' => $description,
            'color' => $color,
            'size_s' => $sizeS,
            'size_m' => $sizeM,
            'size_l' => $sizeL,
            'category' => $category,
  
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
        ];

        $success = $this->productModel->addProduct($title, $price,$type, $attributes);

        if ($success) {
            header('Location: ../public/ManageProducts.php?success=1');
        } else {
            header('Location: ../public/addProduct.php?error=1');
        }
        exit();
    }


    private function uploadFiles()
    {
        $uploadedFiles = [];
        $maxFiles = 3;

        if (!empty($_FILES['photo']['tmp_name'])) {
            foreach ($_FILES['photo']['tmp_name'] as $index => $tmpName) {
                if (!empty($tmpName) && count($uploadedFiles) < $maxFiles) {
                    $fileName = basename($_FILES['photo']['name'][$index]);
                    $targetPath = __DIR__ . '/../Assets/uploads/' . $fileName;

                    if (!is_dir(__DIR__ . '/../Assets/uploads/')) {
                        mkdir(__DIR__ . '/../Assets/uploads/', 0777, true);
                    }

                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $uploadedFiles[] = $fileName;
                    }
                }
            }
        }

        return $uploadedFiles;
    }

    public function getAllProducts()
    {
        // Fetch products and their attributes from the model
        $products = $this->productModel->getProducts();

        if ($products === false) {
            die("Failed to fetch products.");
        }

        return $products;
    }

    public function deleteProduct()
    {
        header('Content-Type: application/json'); // Ensure JSON response
        try {
            // Check if the request is POST and an ID is provided
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                $productId = htmlspecialchars($_POST['id']); // Sanitize the input
                
                // Call the model to delete the product
                if ($this->productModel->deleteProduct($productId)) {
                    echo json_encode(['success' => true, 'message' => 'Product deleted successfully.']);
                } else {
                    // Send failure message if deletion fails
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => 'Failed to delete product.']);
                }
            } else {
                // Send a 400 Bad Request error if no ID is provided
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            }
        } catch (Exception $e) {
            // Log any exceptions and return a 500 error
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}

// Check if the deleteProduct flag is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteProduct']) && isset($_POST['id'])) {
    $productController = new ProductController();
    $productController->deleteProduct();
    exit;
}

// Call the handleRequest method to process form submissions
$productController = new ProductController();
$productController->handleRequest();
