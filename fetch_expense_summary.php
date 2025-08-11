<?php
include 'db_connection.php';

// Get the current month
$currentMonth = date('Y-m');

// SQL query to get the total amount per category for the current month
$sql = "SELECT Expense_category, SUM(Expense_amount) AS total_amount 
        FROM personal_expense
        WHERE Expense_date LIKE ?
        GROUP BY Expense_category";

$stmt = $conn->prepare($sql);
$likeMonth = $currentMonth . '%'; // Format to match year and month (e.g., '2024-12%')
$stmt->bind_param('s', $likeMonth);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the data and prepare it for output
$summary = [];
while ($row = $result->fetch_assoc()) {
    $summary[] = $row;
}

// Close the connection
$stmt->close();
$conn->close();

// Return the data as JSON
echo json_encode($summary);
?>
