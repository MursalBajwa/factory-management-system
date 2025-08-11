<?php
// Start the session
session_start();

// Include the database connection
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form inputs
    $searchBy = $_POST['searchBy'];
    $searchValue = $conn->real_escape_string($_POST['searchValue']);

    // Initialize query based on the search criteria
    if ($searchBy == "id") {
        $query = "SELECT * FROM customer WHERE Customer_id = '$searchValue'";
    } elseif ($searchBy == "name") {
        $query = "SELECT * FROM customer WHERE Customer_name LIKE '%$searchValue%'";
    } else {
        $_SESSION['error'] = "Invalid search criteria.";
        header("Location: display_customer.php");
        exit();
    }

    // Execute the query
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Store the fetched data in a session variable
        $_SESSION['customer_data'] = $result->fetch_all(MYSQLI_ASSOC);
    }
    else{
        $_SESSION['Not_record'] = True;
    }
    // Redirect to the display page
    header("Location: Customer Management.php");
    exit();
}

// Close the database connection
$conn->close();
?>
