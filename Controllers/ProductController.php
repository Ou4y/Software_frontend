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

        // Now pass the connection to the Product class constructor
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

    private function addProduct()
{
    // Sanitize input data
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $color = htmlspecialchars(trim($_POST['color']));
    $size_s = htmlspecialchars(trim($_POST['size_s']));
    $size_m = htmlspecialchars(trim($_POST['size_m']));
    $size_l = htmlspecialchars(trim($_POST['size_l']));
    $price = htmlspecialchars(trim($_POST['price']));
    $category = htmlspecialchars(trim($_POST['category']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $discount = htmlspecialchars(trim($_POST['disnumber'])); // Correct key name
    $images = $this->uploadFiles();

    // Extract individual images
    $picture1 = $images[0];
    $picture2 = $images[1];
    $picture3 = $images[2];

    // Pass the data to the model to add the product
    if ($this->productModel->addProduct(
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
    )) {
        $_SESSION['success_message'] = "Product added successfully!";
        header('Location: ../public/admin.php');
        exit();
    } else {
        $_SESSION['error_message'] = "Error: Unable to add product.";
        header('Location: ../public/admin.php');
        exit();
    }
}

    
private function uploadFiles()
{
    $uploadedFiles = [];
    $maxFiles = 3; // Limit to three pictures

    if (!empty($_FILES['photo']['tmp_name'])) {
        foreach ($_FILES['photo']['tmp_name'] as $index => $tmpName) {
            if (!empty($tmpName) && count($uploadedFiles) < $maxFiles) {
                $fileName = htmlspecialchars(basename($_FILES['photo']['name'][$index]));
                $targetPath = __DIR__ . '/../Assets/uploads/' . $fileName;

                // Ensure the uploads directory exists
                if (!is_dir(__DIR__ . '/../Assets/uploads/')) {
                    mkdir(__DIR__ . '/../Assets/uploads/', 0777, true);
                }

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $uploadedFiles[] = $fileName;
                } else {
                    error_log("File upload failed for $fileName");
                }
            }
        }
    }

    // Pad the array to ensure exactly three elements (use NULL for empty slots)
    while (count($uploadedFiles) < $maxFiles) {
        $uploadedFiles[] = null;
    }

    return $uploadedFiles;
}

    

    
    public function getAllProducts() {
        // Fetch products from the model
        $products = $this->productModel->getProducts();
        return $products;
        // Check if products were fetched successfully
        if ($products === false) {
            die("Failed to fetch products.");
        }
    }


    public function deleteproduct()
{
    header('Content-Type: application/json'); // Ensure JSON response
    try {
        // Check if the request is POST and an ID is provided
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $productid = htmlspecialchars($_POST['id']); // Sanitize the input
            
            // Call the model to delete the product
            if ($this->productModel->deleteproduct($productid)) {
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
    $productController->deleteproduct();
    exit;
}




// Call the handleRequest method to process form submissions
$productController = new ProductController();
$productController->handleRequest();




$controller = new ProductController();
$controller->getAllProducts();



?>
