<?php

session_start();


$conn=mysqli_connect("localhost","root","","X");


        if(!$conn){
            die("connection failed ". mysqli_connect_error());
        }




        error_reporting(E_ALL);
ini_set('display_errors', 1);





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formType = isset($_POST['form_type']) ? htmlspecialchars($_POST['form_type']) : '';

    if ($formType === 'sign_up') {
        // Retrieve sign-up form data
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $phoneNumber = htmlspecialchars($_POST['Number']);

        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO customer (Username, Email, Password, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $phoneNumber); // 'ssss' means all four are strings

        // Execute the statement
        if ($stmt->execute()) {
            echo "<h2 style='color: green;'>New record created successfully.</h2>";
        } else {
            echo "<h2 style='color: red;'>Error: " . $stmt->error . "</h2>";
        }

        // Close the statement
        $stmt->close();
    } elseif ($formType === 'sign_in') {
        // Handle sign-in form data
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $isAdmin = isset($_POST['type']) ? 'Yes' : 'No';

        // Prepare a SQL statement to check user credentials
        if ($isAdmin === 'Yes') {
            // Check in the admin table
            $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        } else {
            // Check in the customer table
            $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ?");
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user is found
        if ($result->num_rows > 0) {
            // Fetch user data
            $user = $result->fetch_assoc();
            // Verify password
            
            if (password_verify($password, $user['Password'])) {
                echo "<h2 style='color: green;'>Login successful!</h2>";

                if($isAdmin==='Yes'){
                    header("Location: ../public/admin.php"); // Change 'account.php' to your actual account page URL
                exit(); // Always call exit after a header redirect
                }
                
                // User found and password verified, redirect to account page
                header("Location: ../public/myaccount.php"); // Change 'account.php' to your actual account page URL
                exit(); // Always call exit after a header redirect
            } else {
                 // Password is incorrect, set an error message
                 $_SESSION['error_message'] = "Invalid password!";
                 header("Location: ../public/LoginSignup.php"); // Redirect back to the form page
                 exit();
            }
        } else {
            // User not found
            if ($isAdmin === 'Yes') {
                $_SESSION['error_message'] = "Admin not found!";
                 header("Location: ../public/LoginSignup.php"); // Redirect back to the form page
                 exit();
            } else {
                $_SESSION['error_message'] = "Customer not found!";
                header("Location: ../public/LoginSignup.php"); // Redirect back to the form page
                exit();
            }
        }

        // Close the statement
        $stmt->close();
    } else {
       
    }
} else {
   
}





?>

       