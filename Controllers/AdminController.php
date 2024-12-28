<?php
require_once(__DIR__ . '/../Models/AdminDashboard.php');
require_once(__DIR__ . '/../DataBase.php');

class AdminController {
    private $AdminControllermodel;

    public function __construct()
    {
        $dbConnection = (new Database())->getConnection();
        $this->AdminControllermodel = new AdminDashboard($dbConnection); 
    }

    // Function to get the dashboard data
    public function getDashboardData() {
        $totalUsers = $this->AdminControllermodel->getTotalUsers(); 
        $totalProducts = $this->AdminControllermodel->getTotalProducts(); 
        $totalOrders = $this->AdminControllermodel->getTotalOrders();
        $orders = $this->AdminControllermodel->getOrders(); // Get orders data

        return [
            'totalUsers' => $totalUsers,
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'orders' => $orders, // Add orders to the data
        ];
    }
    
}
?>
