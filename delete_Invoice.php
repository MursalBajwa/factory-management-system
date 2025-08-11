<?php
session_start();
// Include the database connection
include 'db_connection.php';

// Check if the invoice_id is set and not empty
if (isset($_POST['invoice_id']) && !empty($_POST['invoice_id'])) {
    $invoice_id = $_POST['invoice_id'];

    // Prepare the delete query
    $query = "DELETE FROM temp_invoice WHERE temp_Invoice_id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $invoice_id); // Bind the invoice_id parameter
    
    if ($stmt->execute()) {
        // Success response
        echo json_encode(['status' => 'success']);
    } else {
        // Error response
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete the invoice.']);
    }

    // Close the connection
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid invoice ID.']);
}

$conn->close();
?>
