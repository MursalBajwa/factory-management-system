<?php
// Include database connection
include 'db_connection.php';

if (isset($_POST['chequeId'])) {
    $chequeId = $_POST['chequeId'];

    // Fetch cheque details
    $query = "SELECT * FROM cheque WHERE Cheque_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $chequeId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare response
    $response = [];

    if ($result->num_rows > 0) {
        // Fetch cheque data
        $row = $result->fetch_assoc();
        $response = [
            'success' => true,
            'data' => [
                'Cheque_number' => $row['Cheque_number'],
                'Cheque_amount' => $row['Cheque_amount'],
                'Cheque_date' => $row['Cheque_date'],
                'Cheque_status' => $row['Cheque_status']
            ]
        ];
    } else {
        $response = ['success' => false];
    }

    // Return JSON response
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Cheque ID is missing']);
}

// Close connection
$conn->close();
?>
