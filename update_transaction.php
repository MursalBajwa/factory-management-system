<?php
session_start();
// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the form values
    $receiptNumber = $conn->real_escape_string($_POST['updatereceiptNumber']);
    $customerId = $conn->real_escape_string($_POST['updatecustomerId']);
    $transactionAmount = $conn->real_escape_string($_POST['updatetransactionAmount']);
    $transactionDate = $conn->real_escape_string($_POST['updatetransactionDate']);

    // Update the record in the database
    $updateQuery = "UPDATE cash_transaction 
                    SET Customer_id = '$customerId', 
                        Transaction_amount = '$transactionAmount', 
                        Transaction_date = '$transactionDate' 
                    WHERE Recipt_Number = '$receiptNumber'";

    if ($conn->query($updateQuery) === TRUE) {
        $_SESSION['updatedCash'] = 'true';
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
