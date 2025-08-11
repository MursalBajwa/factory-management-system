<?php
session_start();
// Include the database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_email = $_POST['userEmail'];
    $user_password = $_POST['userPassword'];

    // Hash the password for security
    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

    // Check if the email already exists in the database
    $check_sql = "SELECT * FROM user_authentication WHERE User_email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $user_email);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        $_SESSION['dublicate'] = 'true';
        header("Location: Home.php");
        exit();
    }

    // If the email does not exist, insert the new user
    $sql = "INSERT INTO user_authentication (User_email, User_password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user_email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['success'] = 'true';
        header("Location: Home.php");
        exit();
    } else {
        $_SESSION['error'] = 'true.';
        header("Location: Home.php");
        exit();
    }

    // Close the statements and connection
    $check_stmt->close();
    $stmt->close();
    $conn->close();
}
?>
