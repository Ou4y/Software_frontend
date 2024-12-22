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
        $sizes = htmlspecialchars(trim($_POST['sizes']));
        $quantity = htmlspecialchars(trim($_POST['quantity']));
        $price = htmlspecialchars(trim($_POST['price']));
        $category = htmlspecialchars(trim($_POST['category']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $discount = htmlspecialchars(trim($_POST['discount']));
        $images = $this->uploadFiles();

        // Pass the data to the model to add the product
        if ($this->productModel->addProduct($title, $description, $color, $sizes, $quantity, $price, $category, $gender, $discount, $images)) {
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
        if (!empty($_FILES['photo']['tmp_name'])) {
            foreach ($_FILES['photo']['tmp_name'] as $index => $tmpName) {
                if (!empty($tmpName)) {
                    $fileName = htmlspecialchars(basename($_FILES['photo']['name'][$index]));
                    $targetPath = __DIR__ . '/../Assets/uploads/' . $fileName;
                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $uploadedFiles[] = $fileName;
                    } else {
                        error_log("File upload failed for $fileName");
                    }
                }
            }
        }
        return implode(',', $uploadedFiles);
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

}



// Call the handleRequest method to process form submissions
$productController = new ProductController();
$productController->handleRequest();




$controller = new ProductController();
$controller->getAllProducts();



?>
