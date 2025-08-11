<?php
session_start();
// Include the database connection
include 'db_connection.php';

// Check if the database connection is successful
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$status = 'Rejected';

// Fetch all records from temp_invoice table, join with product and customer tables
$query = "
    SELECT temp_invoice.*, 
           product.product_name, 
           product.product_category, 
           customer.Customer_name, 
           customer.Customer_contact, 
           customer.Customer_address
    FROM temp_invoice
    LEFT JOIN product ON temp_invoice.temp_Product_id = product.product_id
    LEFT JOIN customer ON temp_invoice.temp_Customer_id = customer.Customer_id
    WHERE temp_invoice.Acceptence_status = ?
    ORDER BY temp_invoice.temp_Invoice_id
";

// Prepare the statement
$stmt = $conn->prepare($query);

// Check if the statement preparation was successful
if (!$stmt) {
    die("Query Preparation Failed: " . $conn->error);
}

// Bind the parameters (status is a string)
$stmt->bind_param("s", $status);

// Execute the query
$stmt->execute();

// Check if the execution was successful
if ($stmt->error) {
    die("Query Execution Failed: " . $stmt->error);
}

// Get the result
$result = $stmt->get_result();

// Prepare the response data
$invoices = [];
if ($result->num_rows > 0) {
    // Loop through the result and store it in an array
    while ($row = $result->fetch_assoc()) {
        $invoices[] = $row;
    }

    // Return the data as a JSON response
    echo json_encode(['status' => 'success', 'data' => $invoices]);
} else {
    // If no records are found, return an error message
    echo json_encode(['status' => 'error', 'message' => 'No records found']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
