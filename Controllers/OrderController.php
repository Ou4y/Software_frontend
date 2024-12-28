<?php
session_start();

// Include the database connection and model files
require_once(__DIR__ . '/../Models/ConfirmOrder.php');
require_once (__DIR__ . '/../Models/DataBase.php');

// Enable detailed error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize the database connection
$dbConnection = Database::getInstance()->getConnection();

// Create a new instance of the model with the database connection
$orderModel = new ConfirmOrderModel($dbConnection);

// Check if the user is logged in
$userId = $_SESSION['user']['id'] ?? null;
if (!$userId) {
    header('Location: ../Views/public/LoginSignup.php');
    exit;
}

// Handle the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $zipCode = $_POST['zip_code'] ?? '';
    $cartItems = json_decode($_POST['cart_items'], true);
    $totalAmount = $_POST['total_amount'] ?? 0;

    // Validate input
    if (empty($firstName) || empty($email) || empty($address) || empty($city) || empty($zipCode) || empty($cartItems)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // Process the order
    $orderDate = date('Y-m-d H:i:s');
    $name = $firstName . ' ' . ($_POST['last_name'] ?? '');

    // Begin transaction to ensure consistency
    $orderModel->beginTransaction();

    try {
        // Create the order
        $orderId = $orderModel->createOrder($userId, $name, $email, $address, $city, $zipCode, $orderDate, $totalAmount);
        
        // Create order items
        foreach ($cartItems as $item) {
            $orderModel->createOrderItem($orderId, $item['productId'], $item['quantity'], $item['price']);
        }

        // Commit the transaction
        $orderModel->commitTransaction();
        header('Location: ../Views/public/Confirmation.php');
    } catch (Exception $e) {
        // Rollback transaction in case of an error
        $orderModel->rollbackTransaction();
        
        // Log the error message for debugging
        error_log("Order placement failed: " . $e->getMessage());
        
        // Return a detailed error message to the user
        echo json_encode(['success' => false, 'message' => 'Failed to place the order.', 'error' => $e->getMessage()]);
    }
}
?>
