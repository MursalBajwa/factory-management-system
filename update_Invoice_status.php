<?php
// Include the database connection
include 'db_connection.php';

// Check if action and invoice_id are provided
if (isset($_POST['action'], $_POST['invoice_id'])) {
    $action = $_POST['action'];
    $invoiceId = $_POST['invoice_id'];

    // Determine the new status
    $newStatus = ($action == 'accept') ? 'Accepted' : 'Rejected';

    // Update query to update status for all products in the invoice
    $updateQuery = "UPDATE temp_invoice SET Acceptence_status = ? WHERE temp_Invoice_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newStatus, $invoiceId);
    

    if ($stmt->execute()) {
        // Return success
        echo json_encode(['status' => 'success']);
    } else {
        // Return error
        echo json_encode(['status' => 'error']);
    }

    $stmt->close();
}

$conn->close();
?>
