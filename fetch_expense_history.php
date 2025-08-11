<?php
include 'db_connection.php'; // Include your database connection

// SQL query to fetch all records from the personal_expense table
$sql = "SELECT Expense_id, Expense_description, Expense_amount, Expense_category, Expense_date 
        FROM personal_expense 
        ORDER BY Expense_date DESC";


$result = $conn->query($sql);

// Fetch all records
$expenses = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }
}

// Close the connection
$conn->close();

// Return the data as JSON
echo json_encode($expenses);
?>
