<?php
// Include database connection
include 'db_connection.php'; // Replace with your actual connection file

// Start session to access session variables
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected User_id, new email, and password from the form
    $update_user_id = $_POST['updateUserId'];
    $update_user_email = $_POST['updateUserEmail'];
    $update_user_password = $_POST['updateUserPassword'];

    // Check if a valid User_id, email, and password are provided
    if (!empty($update_user_id) && !empty($update_user_email) && !empty($update_user_password)) {
        
        // Hash the new password for security
        $hashed_password = password_hash($update_user_password, PASSWORD_BCRYPT);

        // SQL query to update the user's details in the database
        $sql = "UPDATE user_authentication SET User_email = ?, User_password = ? WHERE User_id = ?";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $update_user_email, $hashed_password, $update_user_id);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['updated'] = 'true';
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
        echo "Please fill in all fields.";
    }

    // Close the database connection
    $conn->close();
}
?>
