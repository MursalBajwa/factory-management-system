<?php
// Include database connection
include 'db_connection.php';

// Get the cheque number from the GET request
$chequeNumber = $_GET['chequeNumber'];

// Query to fetch cheque details for the selected cheque number
$query = "SELECT Cheque_amount, Cheque_date, Cheque_status, Customer_id 
          FROM cheque 
          WHERE Cheque_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $chequeNumber);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($Cheque_amount, $Cheque_date, $Cheque_status, $Customer_id);

// Prepare the response array
$response = [];
if ($stmt->fetch()) {
    $response = [
        'Cheque_amount' => $Cheque_amount,
        'Cheque_date' => $Cheque_date,
        'Cheque_status' => $Cheque_status,
        'Customer_id' => $Customer_id
    ];
    echo json_encode(['success' => true, 'data' => $response]);
} else {
    echo json_encode(['success' => false]);
}

// Close connection
$stmt->close();
$conn->close();
?>
