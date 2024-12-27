<?php 
require_once('../../Models/ConfirmOrder.php');
session_start();

class OrderController
{
    private $orderModel;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
        $this->orderModel = new ConfirmOrder($this->db);
    }

    public function handleCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'checkoutForm') {
            // Get form data
            $userId = $_SESSION['user_id']; // Assuming the user is logged in and their ID is stored in session
            $paymentType = $_POST['payment_type']; // Payment method
            $totalAmount = floatval($_POST['total_amount']); // Total order amount from the frontend

            // Create the order
            $result = $this->orderModel->createOrder($userId, $paymentType, $totalAmount);

            if ($result) {
                $orderId = $this->db->insert_id; // Get the last inserted order ID

                // Process each cart item
                $cartItems = json_decode($_POST['cart_items'], true); // Assuming cart items are sent as a JSON array

                foreach ($cartItems as $item) {
                    // Add order items to the database
                    $this->orderModel->addOrderItem($orderId, $item['product_id'], $item['quantity'], $item['price']);
                }

                // Redirect or return a success message
                header('Location: thank_you.php?order_id=' . $orderId);
                exit;
            } else {
                // Handle the error if the order was not placed
                $error = "Failed to place the order. Please try again.";
                echo $error; // You can display an error message here
            }
        }
    }
}

// Instantiate and call the handleCheckout method
$controller = new OrderController($db); // Assume $db is your database connection
$controller->handleCheckout();

?>
