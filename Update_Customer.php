<?php
session_start();
// Include the database connection
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $customerId = $_POST['updateCustomerId'];
    $customerName = $_POST['updateCustomerName'];
    $customerContact = $_POST['updateCustomerContact'];
    $customerAddress = $_POST['updateCustomerAddress'];

    // Sanitize the input data (optional but recommended)
    $customerName = mysqli_real_escape_string($conn, $customerName);
    $customerContact = mysqli_real_escape_string($conn, $customerContact);
    $customerAddress = mysqli_real_escape_string($conn, $customerAddress);

    // Update query to update the customer information
    $sql = "UPDATE customer SET 
                Customer_name = '$customerName',
                Customer_contact = '$customerContact',
                Customer_address = '$customerAddress'
            WHERE Customer_id = '$customerId'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // If successful, redirect or display a success message
        $_SESSION['updated'] = 'true';
        header("Location: Customer Management.php");
        exit();
    } else {
        $_SESSION['error'] = 'true';
        header("Location: Customer Management.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
