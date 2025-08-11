<?php
// Start session to access session variables
session_start();

// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs and sanitize them
    $customerName = $conn->real_escape_string($_POST['customerName']);
    $customerContact = $conn->real_escape_string($_POST['customerContact']);
    $customerAddress = $conn->real_escape_string($_POST['customerAddress']);
    $userId = $conn->real_escape_string($_POST['UserId']);

    // Check if the customer already exists
    $checkQuery = "SELECT * FROM customer 
                   WHERE Customer_name = '$customerName' 
                   AND Customer_contact = '$customerContact' ";

    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // If a matching record is found, display an error message
        $_SESSION['dublicate'] = 'true';
        header("Location: Customer Management.php");
        exit();
    } else {
        // If no match is found, insert the new customer
        $sql = "INSERT INTO customer (Customer_name, Customer_contact, Customer_address, User_id)
                VALUES ('$customerName', '$customerContact', '$customerAddress', '$userId')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = 'true';
            header("Location: Customer Management.php");
            exit();
        } else {
            $_SESSION['success'] = 'true';
            header("Location: Customer Management.php");
            exit();
        }
    }
}

// Close the connection
$conn->close();
?>
