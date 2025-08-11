<?php
session_start();
// Include the database connection
include 'db_connection.php';

$status = 'Pending';
// Fetch all records from temp_invoice table, and join with the product table to get the product name and category
$query = "
    SELECT temp_invoice.*, product.product_name, product.product_category
    FROM temp_invoice
    LEFT JOIN product ON temp_invoice.temp_Product_id = product.product_id
    WHERE temp_invoice.temp_Customer_id = ? AND temp_invoice.Acceptence_status = ?
    ORDER BY temp_invoice.temp_Invoice_id
";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $_SESSION['Customer_id'], $status); // Assuming both are strings
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query Failed: " . $conn->error); // This will show the exact error from the database
}

$invoices = [];
if ($result->num_rows > 0) {
    // Loop through the result and store it in an array
    while ($row = $result->fetch_assoc()) {
        $invoices[] = $row;
    }

    // Return the data as a JSON response
    echo json_encode(['status' => 'success', 'data' => $invoices]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No records found']);
}

$conn->close();
?>
