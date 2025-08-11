<?php
session_start(); // Start the session

// Include the database connection file
include('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch user inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for customer login
    $customer_query = "SELECT ua.User_id, ua.User_email, ua.User_password, c.Customer_name ,c.Customer_id
                       FROM user_authentication ua
                       JOIN customer c ON ua.User_id = c.User_id
                       WHERE ua.User_email = ?";
    $stmt = $conn->prepare($customer_query);
    $stmt->bind_param("s", $email); // Bind email to the query
    $stmt->execute();
    $customer_result = $stmt->get_result();

    if ($customer_result->num_rows > 0) {
        // Customer found, fetch customer data
        $customer_data = $customer_result->fetch_assoc(); 

        // Verify password using password_verify
        if (password_verify($password, $customer_data['User_password'])) {
            // Password is correct, set session for customer
            $_SESSION['IS_CUSTOMER_LOGIN'] = TRUE;
            $_SESSION['User_email'] = $email; // Store user email in session
            $_SESSION['User_id'] = $customer_data['User_id']; // Store user ID in session
            $_SESSION['Customer_id'] = $customer_data['Customer_id']; // Store user ID in session
            $_SESSION['User_name'] = $customer_data['Customer_name']; // Store customer name in session
            header("Location: Customer_notification.php"); // Redirect to customer dashboard
            exit();
        } else {
            // Invalid password
            echo "Invalid email or password!";
        }
    } else {
        // Check for admin login
        $admin_query = "SELECT * FROM admin WHERE Admin_email = ?";
        $stmt = $conn->prepare($admin_query);
        $stmt->bind_param("s", $email); // Bind email to the query
        $stmt->execute();
        $admin_result = $stmt->get_result();

        if ($admin_result->num_rows > 0) {
            // Admin found, fetch admin data
            $admin_data = $admin_result->fetch_assoc(); 

            // Verify password using password_verify
            if (password_verify($password, $admin_data['Admin_password'])) {
                // Password is correct, set session for admin
                $_SESSION['IS_ADMIN_LOGIN'] = TRUE;
                $_SESSION['Admin_email'] = $email; // Store admin email in session
                $_SESSION['Admin_id'] = $admin_data['Admin_id']; // Store admin ID in session
                $_SESSION['Admin_name'] = $admin_data['Admin_name']; // Store admin name in session
                header("Location: Home.php"); // Redirect to admin dashboard
                exit();
            } else {
                // Invalid password
                echo "Invalid email or password!";
            }
        } else {
            // Invalid login credentials
            echo "Invalid email or password!";
        }
    }

    $stmt->close();
}
$conn->close();
?>
