<?php
// Include the database connection
include 'db_connection.php';

// Get the Receipt Number from the GET request
$receiptNumber = $conn->real_escape_string($_GET['receiptNumber']);

// Query to fetch cash transaction details based on the Receipt Number
$query = "SELECT * FROM cash_transaction WHERE Recipt_Number = '$receiptNumber'";
$result = $conn->query($query);

// Prepare response
$response = array();

if ($result->num_rows > 0) {
    $response['success'] = true;
    $response['data'] = array();

    // Fetch all rows and add to response data
    while ($row = $result->fetch_assoc()) {
        $response['data'][] = $row;
    }
} else {
    $response['success'] = false;
}

// Return the JSON response
echo json_encode($response);

// Close the connection
$conn->close();
?>
