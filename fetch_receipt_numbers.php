<?php
// Include database connection
include 'db_connection.php';

// Query to fetch Receipt Numbers from the cash_transaction table
$query = "SELECT Recipt_Number FROM cash_transaction";
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
