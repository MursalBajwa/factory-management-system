<?php
session_start();
// Include the database connection file
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $description = $_POST['expenseDescription'];
    $amount = $_POST['expenseAmount'];
    $category = $_POST['expenseCategory'];
    $date = date('Y-m-d'); // Current date

    // Check for duplicate entry
    $checkSql = "SELECT * FROM personal_expense 
                 WHERE Expense_description = '$description' 
                 AND Expense_amount = '$amount' 
                 AND Expense_category = '$category' 
                 AND Expense_date = '$date'";

    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $_SESSION['dublicateExpense'] = 'true';
        header("Location: Personal expense Management.php");
        exit();
    } else {
        // If no duplicate, insert data
        $sql = "INSERT INTO personal_expense (Expense_description, Expense_amount, Expense_category, Expense_date)
                VALUES ('$description', '$amount', '$category', '$date')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['successExpense'] = 'true';
            header("Location: Personal expense Management.php");
            exit();
        } else {
            $_SESSION['errorExpense'] = 'true';
            header("Location: Personal expense Management.php");
            exit();
        }
    }

    // Close the connection
    $conn->close();
}
?>
