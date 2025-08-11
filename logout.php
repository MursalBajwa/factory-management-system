<?php
session_start(); // Start the session

// Destroy all session data to log out the user
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to the login page after logout
header("Location: login.html");
exit();
?>
