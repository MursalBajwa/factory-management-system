<?php
// Include database connection
include 'db_connection.php';

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['searchCategory'];
    $fromDate = $_POST['FromexpenseDate'];
    $untilDate = $_POST['UntillexpenseDate'];

    // Sanitize input to prevent SQL injection
    $category = $conn->real_escape_string($category);
    $fromDate = $conn->real_escape_string($fromDate);
    $untilDate = $conn->real_escape_string($untilDate);

    // Query to search expenses
    $sql = "SELECT Expense_description, Expense_amount, Expense_date 
            FROM personal_expense 
            WHERE Expense_category = '$category' 
              AND Expense_date BETWEEN '$fromDate' AND '$untilDate'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>Description:</strong> " . $row['Expense_description'] . 
                 ", <strong>Amount:</strong> $" . $row['Expense_amount'] . 
                 ", <strong>Date:</strong> " . $row['Expense_date'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No results found.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
