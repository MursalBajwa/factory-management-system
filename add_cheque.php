<?php
session_start();
// Include database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $chequeNumber = $_POST['chequeNumber'];
    $chequeAmount = $_POST['chequeAmount'];
    $chequeDate = $_POST['chequeDate'];
    $chequeStatus = $_POST['chequeStatus'];
    $customerId = $_POST['customerId'];

    // Validate required fields
    if (!empty($chequeNumber) && !empty($chequeAmount) && !empty($chequeDate) && !empty($chequeStatus) && !empty($customerId)) {
        // Insert cheque details into the database
        $query = "INSERT INTO cheque (Cheque_number, Cheque_amount, Cheque_date, Customer_id, Cheque_status) 
                  VALUES (?, ?, ?, ?, ?)";

        // Prepare statement
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("sssis", $chequeNumber, $chequeAmount, $chequeDate, $customerId, $chequeStatus);
            
            // Execute the query
            if ($stmt->execute()) {
                $_SESSION['successCheque'] = 'true';
                header("Location: Cheque Management.php");
                exit();
            } else {
                $_SESSION['errorCheque'] = 'true';
                header("Location: Cheque Management.php");
                exit();
            }

            // Close statement
            $stmt->close();
        }
    } else {
        $_SESSION['errorCheque'] = 'true';
        header("Location: Cheque Management.php");
        exit();
    }
}

// Close connection
$conn->close();
?>