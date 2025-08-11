<?php
// Start session to store user data
session_start();

// Set session variable when the user visits fetch_users.php
$_SESSION['came_from_fetch_users'] = true;

// Include database connection
include 'db_connection.php'; // Replace with your database connection file

// SQL query to fetch all user IDs and emails
$sql = "SELECT User_id, User_email FROM user_authentication";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Initialize an array to hold user IDs
    $user_ids = [];

    // Fetch each row and create <option> tags
    while ($row = $result->fetch_assoc()) {
        // Store user ID in the session array
        $user_ids[] = $row['User_id'] . " - " . $row['User_email'];
        $only_ids[] = $row['User_id'];
    }

    // Store the user IDs in the session
    $_SESSION['user_ids'] = $user_ids;
    $_SESSION['$only_ids'] = $only_ids;

    // Redirect to home.php after storing data
    if($_SESSION['came_from_Customer']== true)
    {
        $_SESSION['came_from_Customer'] = false;
        header("Location: Customer Management.php");
        exit(); // Always call exit after header redirection
    }
    header("Location: Home.php");
    exit(); // Always call exit after header redirection
} else {
    if($_SESSION['came_from_Customer'] == true)
    {
        $_SESSION['came_from_Customer'] = false;
        header("Location: Customer Management.php");
        exit(); // Always call exit after header redirection
    }
    // If no users are found, redirect to home.php
    header("Location: Home.php");
    exit(); // Always call exit after header redirection
}

// Close the database connection
$conn->close();
?>
