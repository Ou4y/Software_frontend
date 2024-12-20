<?php
include_once '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['ID'];


    $id = mysqli_real_escape_string($conn, $id);


    $sql = "DELETE FROM customer WHERE ID='$id'";
    
    if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully.";
    } else {
        http_response_code(500);
        echo "Error deleting user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
