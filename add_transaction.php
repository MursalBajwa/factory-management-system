<?php
session_start();
// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the form values and sanitize them
    $customerId = $conn->real_escape_string($_POST['customerId']);
    $receiptNumber = $conn->real_escape_string($_POST['receiptNumber']);
    $transactionAmount = $conn->real_escape_string($_POST['transactionAmount']);
    $transactionDate = $conn->real_escape_string($_POST['transactionDate']);

    // Insert the data into the database
    $insertQuery = "INSERT INTO cash_transaction (Customer_id, Transaction_amount, Transaction_date, Recipt_Number)
                    VALUES ('$customerId', '$transactionAmount', '$transactionDate', '$receiptNumber')";

    if ($conn->query($insertQuery) === TRUE) {
        $_SESSION['successCash'] = 'true';
        header("Location: Cash Receipt and Payment Management.php");
        exit();
    } else {
        $_SESSION['errorCash'] = 'true';
        header("Location: Cash Receipt and Payment Management.php");
        exit();
    }
}

// Close the connection
$conn->close();
?>
