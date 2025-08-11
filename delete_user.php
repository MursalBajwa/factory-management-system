<?php
// Include database connection
include 'db_connection.php'; // Replace with your actual connection file

// Start session to access session variables
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected User_id from the form
    $delete_user_id = $_POST['deleteUserId'];

    // Check if a valid User_id is selected
    if (!empty($delete_user_id)) {
        // SQL query to delete the user from the database
        $sql = "DELETE FROM user_authentication WHERE User_id = ?";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $delete_user_id);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['deleted'] = 'true';
            header("Location: Home.php");
            exit();
        } else {
            $_SESSION['error'] = 'true';
            header("Location: Home.php");
            exit();
        }

        // Close the statement
        $stmt->close();
    } else {
        $_SESSION['error'] = 'true';
    }

    // Close the database connection
    $conn->close();
}
?>
