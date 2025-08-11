<?php
// Include database connection
include 'db_connection.php';

// Fetch all cheque numbers
$query = "SELECT Cheque_id, Cheque_number FROM cheque";
$result = $conn->query($query);

$response = [];

if ($result->num_rows > 0) {
    // Collect cheque numbers
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
