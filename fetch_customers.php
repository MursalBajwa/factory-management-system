<?php
// Include database connection
include 'db_connection.php';

// Query to fetch customers from the customer table
$query = "SELECT Customer_id, Customer_name FROM customer";
$result = $conn->query($query);

// Prepare the response array
$response = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $response]);
} else {
    echo json_encode(['success' => false]);
}

// Close connection
$conn->close();
?>
